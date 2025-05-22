<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

    protected $fillable = [
        'voucher_type_id', 'code', 'is_active',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    // Relasi ke VoucherType supaya bisa ambil discount_amount, valid_until, dll
    public function voucherType()
    {
        return $this->belongsTo(VoucherType::class);
    }

    // Akses attribute discount_amount langsung dari voucherType
    public function getDiscountAmountAttribute()
    {
        return $this->voucherType ? $this->voucherType->discount_amount : null;
    }

    // Akses valid_until dari voucherType, dikonversi ke objek Carbon
    public function getValidUntilAttribute()
    {
        if ($this->voucherType && $this->voucherType->valid_until) {
            return Carbon::parse($this->voucherType->valid_until);
        }
        return null;
    }
}
