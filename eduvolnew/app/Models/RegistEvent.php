<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistEvent extends Model
{
    use HasFactory;

    protected $table = 'regist_event';
    
    protected $fillable = [
        'user_id',
        'event_id',
        'first_name',
        'last_name',
        'email',
        'mobile_phone',
        'birth_date',
        'voucher_id',
        'status',
        'registration_date'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'registration_id');
    }
} 