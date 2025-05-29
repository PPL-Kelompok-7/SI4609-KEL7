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
        // Ambil juga kolom is_revealed
        $vouchers = Voucher::with('voucherType')
            ->where('user_id', $user->id)
            ->get();

        return view('voucherpengguna', [
            'user' => $user,
            'vouchers' => $vouchers
        ]);
    }

    // Proses "reveal" kode voucher (tombol generate di UI)
    public function reveal(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);

        // Jika kode voucher belum ada, generate dulu dan simpan
        if ($voucher->code === null) {
            $voucher->code = strtoupper(Str::random(10));
        }

        // Tandai voucher sudah "di-reveal" untuk user
        $voucher->is_revealed = true;
        $voucher->save();

        return redirect()->back()->with('success', 'Kode voucher berhasil ditampilkan.');
    }

    // Tampilkan semua voucher milik semua user (admin view)
    public function voucherAll()
    {
        $vouchers = Voucher::with(['voucherType', 'user'])->get();

        return view('voucherall', compact('vouchers'));
    }
}
