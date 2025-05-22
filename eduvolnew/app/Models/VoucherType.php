<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VoucherType extends Model
{
    use HasFactory;

    protected $table = 'voucher_types';

    protected $fillable = [
        'name', 'description', 'discount_amount', 'valid_until',
    ];

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
}
