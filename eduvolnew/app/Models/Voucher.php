<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_amount',
        'valid_from',
        'valid_until',
        'is_active',
        'max_uses',
        'current_uses'
    ];

    protected $casts = [
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'is_active' => 'boolean'
    ];

    // Relationship with Payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function isValid()
    {
        $now = now();
        return $this->is_active &&
               $now->between($this->valid_from, $this->valid_until) &&
               ($this->max_uses === null || $this->current_uses < $this->max_uses);
    }
}
