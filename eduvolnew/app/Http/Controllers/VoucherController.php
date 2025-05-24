<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VoucherType;
use App\Models\Voucher;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    // Tampilkan form untuk membuat voucher type dan generate kode voucher
    public function create()
    {
        return view('buatvoucher');
    }

    // Proses simpan voucher type dan generate kode voucher
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_amount' => 'required|numeric|min:0',
            'valid_until' => 'required|date|after_or_equal:today',
            'generate_count' => 'required|integer|min:1|max:100',
        ]);

        DB::beginTransaction();

        try {
            $voucherType = VoucherType::create([
                'name' => $request->name,
                'description' => $request->description,
                'discount_amount' => $request->discount_amount,
                'valid_until' => $request->valid_until,
            ]);

            $count = $request->generate_count;

            for ($i = 0; $i < $count; $i++) {
                $code = $this->generateUniqueCode();

                Voucher::create([
                    'voucher_type_id' => $voucherType->id,
                    'code' => $code,
                    'is_active' => 1,
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', "Voucher dan {$count} kode voucher berhasil dibuat!");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Gagal membuat voucher: ' . $e->getMessage());
        }
    }

    // Fungsi generate kode voucher unik
    private function generateUniqueCode($length = 10)
    {
        do {
            $code = strtoupper(Str::random($length));
        } while (Voucher::where('code', $code)->exists());

        return $code;
    }

    // Tampilkan form untuk memberikan voucher ke user tertentu
    public function useVoucher($id)
    {
        $voucher = Voucher::findOrFail($id);
        $users = User::select('id', 'first_name')->get();

        return view('use', compact('voucher', 'users'));
    }

    // Proses pemberian voucher ke user yang dipilih
    public function assignVoucher(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $voucher = Voucher::findOrFail($id);
        $voucher->user_id = $request->user_id;
        $voucher->is_active = 0; // misalnya voucher sudah diberikan, jadi tidak aktif lagi
        $voucher->save();

        return redirect()->route('voucherall')->with('success', 'Voucher berhasil diberikan kepada user.');
    }
    
}
