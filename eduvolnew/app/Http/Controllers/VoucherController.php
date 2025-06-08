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
        // Tambahan fitur baru: ambil 3 volunteer teratas
        $topVolunteers = DB::table('regist_event')
            ->join('users', 'regist_event.user_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.email',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"),
                'users.profile_photo',
                DB::raw('COUNT(regist_event.event_id) as event_count')
            )
            ->groupBy('regist_event.user_id', 'users.id', 'users.email', 'users.first_name', 'users.last_name', 'users.profile_photo')
            ->orderByDesc('event_count')
            ->limit(3)
            ->get();

        return view('buatvoucher', compact('topVolunteers'));
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
    if ($voucher->user_id) {
        return redirect()->back()->withErrors('Voucher ini sudah digunakan oleh user.');
    }

    $users = User::select('id', 'first_name')->get();

    // Tambahkan query top volunteers di sini juga, sama seperti di method create()
    $topVolunteers = DB::table('regist_event')
        ->join('users', 'regist_event.user_id', '=', 'users.id')
        ->select(
            'users.id',
            'users.email',
            DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"),
            'users.profile_photo',
            DB::raw('COUNT(regist_event.event_id) as event_count')
        )
        ->groupBy('regist_event.user_id', 'users.id', 'users.email', 'users.first_name', 'users.last_name', 'users.profile_photo')
        ->orderByDesc('event_count')
        ->limit(3)
        ->get();

    return view('use', compact('voucher', 'users', 'topVolunteers'));
}


    // Proses pemberian voucher ke user yang dipilih
    public function assignVoucher(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $voucher = Voucher::findOrFail($id);

        if ($voucher->user_id) {
            return redirect()->back()->withErrors('Voucher ini sudah diberikan ke user lain.');
        }

        $user = User::findOrFail($request->user_id);

        $voucher->update([
            'user_id' => $user->id,
            'is_active' => 0
        ]);

        return redirect()->route('voucher.confirm', [
            'kode' => $voucher->code,
            'user_id' => $user->id,
            'nama' => $user->first_name
        ]);
    }

    public function confirm(Request $request)
{
    $kode = $request->kode;
    $user_id = $request->user_id;
    $nama = $request->nama;

    return view('confirmgivevoucher', compact('kode', 'user_id', 'nama'));
}

}
