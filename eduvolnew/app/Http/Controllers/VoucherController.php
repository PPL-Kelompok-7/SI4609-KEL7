<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VoucherType;
use App\Models\Voucher;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    // Show form to create voucher type and codes
    public function create()
    {
        return view('buatvoucher');
    }

    // Handle form submission, validate & store vouchers
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
            // Create VoucherType
            $voucherType = VoucherType::create([
                'name' => $request->name,
                'description' => $request->description,
                'discount_amount' => $request->discount_amount,
                'valid_until' => $request->valid_until,
            ]);

            // Generate unique voucher codes
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

    // Generate unique random code
    private function generateUniqueCode($length = 10)
    {
        do {
            $code = strtoupper(Str::random($length));
        } while (Voucher::where('code', $code)->exists());

        return $code;
    }

   public function useVoucher($id)
    {
    $voucher = Voucher::findOrFail($id);
    return view('use', compact('voucher')); // pastikan 'use' bukan 'voucher.use'
    }


}
