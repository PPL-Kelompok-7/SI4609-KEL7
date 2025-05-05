<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\RegistEvent;

class DaftarRelawanController extends Controller
{
    public function index($id)
    {
        // Ambil data event berdasarkan id
        $event = Event::findOrFail($id);

        // Format tanggal dan jam dari event
        $tanggal = \Carbon\Carbon::parse($event->start_date)->translatedFormat('l, d F Y');
        $jam = date('H:i', strtotime($event->start_time)) . ' - ' . date('H:i', strtotime($event->end_time));
        $harga = 'Rp ' . number_format($event->price, 0, ',', '.');

        $user = auth()->user();

        // Tampilkan view daftar relawan, kirim data event
        return view('daftarrelawan', compact('event', 'tanggal', 'jam', 'harga', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'mobile_phone' => 'required',
            'keluarga' => 'required',
            'handbook' => 'required',
        ]);

        $user = auth()->user();
        RegistEvent::create([
            'user_id' => $user->id,
            'event_id' => $request->event_id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'mobile_phone' => $request->mobile_phone,
            'birth_date' => $user->birth_date,
            'family_status' => $request->keluarga,
            'handbook_agreement' => $request->handbook,
            'status' => 'pending',
            'registration_date' => now(),
            // tambahkan field lain yang tidak nullable di sini jika ada
        ]);

        return redirect()->route('daftarrelawan', ['id' => $request->event_id])
            ->with('success', 'Pendaftaran berhasil!');
    }
}