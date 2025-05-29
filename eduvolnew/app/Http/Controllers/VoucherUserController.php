<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VoucherUserController extends Controller
{
    // Tampilkan daftar voucher pengguna
    public function index()
    {
        $user = Auth::user();

        // Ambil voucher milik pengguna dari tabel 'vouchers', relasi ke 'voucher_types'
        $vouchers = Voucher::with('voucherType')
            ->where('user_id', $user->id)
            ->get();

        return view('voucherpengguna', [
            'user' => $user,
            'vouchers' => $vouchers
        ]);
    }

    // Proses generate kode voucher
    public function generate(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);

        // Cek apakah sudah ada kode
        if ($voucher->code !== null) {
            return redirect()->back()->with('error', 'Kode sudah digenerate.');
        }

        // Generate kode unik 10 karakter
        $voucher->code = strtoupper(Str::random(10));
        $voucher->save();

        return redirect()->back()->with('success', 'Kode voucher berhasil digenerate.');
    }

    // Tampilkan semua voucher milik semua user
    public function voucherAll()
    {
        $vouchers = Voucher::with(['voucherType', 'user'])->get();

        return view('voucherall', compact('vouchers'));
    }
}
