<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'amount',
        'payment_method_id',
        'payment_status_id',
        'user_id',
        'proof_of_payment',
        'payment_date'
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'amount' => 'decimal:2'
    ];

    public function registration()
    {
        return $this->belongsTo(RegistEvent::class, 'registration_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // Relasi dengan Event melalui RegistEvent
    public function event()
    {
        return $this->hasOneThrough(
            \App\Models\Event::class,
            \App\Models\RegistEvent::class,
            'id', // Foreign key on RegistEvent table...
            'id', // Foreign key on Event table...
            'registration_id', // Local key on Payment table...
            'event_id' // Local key on RegistEvent table...
        );
    }

    // Accessor untuk status mapping (opsional)
    public function getStatusLabelAttribute()
    {
        $map = [
            'Paid' => 'Paid',
            'Unpaid' => 'Unpaid',
            'On Verification' => 'On Verification',
            'Failed' => 'Failed',
            'Refunded' => 'Refunded',
        ];
        return $map[$this->paymentStatus->name] ?? $this->paymentStatus->name;
    }
}