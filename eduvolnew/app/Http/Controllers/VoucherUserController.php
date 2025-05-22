<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherUserController extends Controller
{
    public function index()
    {
        // ambil vouchers dengan relasi voucherType
        $vouchers = Voucher::with('voucherType')->where('is_active', 1)->get();

        return view('voucherpengguna', compact('vouchers'));
    }
     public function voucherAll()
    {
        // Menampilkan halaman voucherall
        $vouchers = Voucher::with('voucherType')->where('is_active', 1)->get();
        return view('voucherall', compact('vouchers'));
    }
}
