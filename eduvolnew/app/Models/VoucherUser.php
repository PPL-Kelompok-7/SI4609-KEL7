<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherUser extends Model
{
    use HasFactory;

    protected $table = 'voucher_users'; // pastikan nama tabel sesuai

    protected $fillable = [
        'user_id',
        'voucher_type_id',
        'code',
    ];

    // Relasi ke tabel voucher_types
    public function voucherType()
    {
        return $this->belongsTo(VoucherType::class, 'voucher_type_id');
    }

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
