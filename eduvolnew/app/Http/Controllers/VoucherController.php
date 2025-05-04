<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        // Ambil semua voucher aktif, bisa filter sesuai kebutuhan
        $vouchers = Voucher::where('is_active', 1)->get();
        return view('voucherpengguna', compact('vouchers'));
    }
}
