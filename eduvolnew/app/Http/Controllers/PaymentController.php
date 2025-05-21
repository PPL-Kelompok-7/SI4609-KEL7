<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\RegistEvent;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class PaymentController extends Controller
{
    // Tampilkan form pembayaran
    public function show($event_id)
    {
        $event = Event::findOrFail($event_id);
        $registration = RegistEvent::where('user_id', Auth::id())
            ->where('event_id', $event_id)
            ->first();

        $payment = null;
        if ($registration) {
            $payment = Payment::where('registration_id', $registration->id)->first();
        }

        $tanggal = \Carbon\Carbon::parse($event->start_date)->translatedFormat('l, d F Y');
        $jam = date('H:i', strtotime($event->start_time)) . ' - ' . date('H:i', strtotime($event->end_time));
        return view('pembayaran', compact('event', 'tanggal', 'jam', 'payment'));
    }

    // Proses upload bukti bayar
    public function uploadProof(Request $request, $eventId)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg|max:10240', // max 10MB
        ]);

        // Simpan file ke storage/app/public/proofs
        $path = $request->file('proof_of_payment')->store('proofs', 'public');

        // Cari registration_id untuk user dan event
        $registration = \App\Models\RegistEvent::where('user_id', auth()->id())
            ->where('event_id', $eventId)
            ->first();
        if (!$registration) {
            return redirect()->back()->withErrors(['msg' => 'Registrasi event tidak ditemukan.']);
        }

        // Ambil status "On Verification" dari tabel payment_statuses
        $status = \App\Models\PaymentStatus::where('name', 'On Verification')->first();
        if (!$status) {
            return redirect()->back()->withErrors(['msg' => 'Status pembayaran tidak ditemukan.']);
        }

        // Ambil payment_method_id default (atau bisa dari input/form jika ada)
        $paymentMethod = \App\Models\PaymentMethod::first();

        // Simpan ke tabel payments
        $payment = \App\Models\Payment::updateOrCreate(
            [
                'registration_id' => $registration->id,
                'user_id' => auth()->id(),
            ],
            [
                'amount' => $request->input('amount', 0),
                'payment_method_id' => $paymentMethod ? $paymentMethod->id : 1,
                'payment_status_id' => $status->id,
                'proof_of_payment' => $path,
                'payment_date' => now(),
            ]
        );

        return redirect('/pembayaran/berhasil')->with('success', 'Bukti pembayaran berhasil diupload!');
    }

    // History pembayaran user
    public function history()
    {
        $user = Auth::user();
        $payments = Payment::whereHas('registration', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['registration.event', 'paymentStatus'])->get();
        return view('historypembayaran', compact('payments'));
    }
} 