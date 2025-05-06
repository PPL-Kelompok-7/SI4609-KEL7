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

        // Temukan payment yang sesuai (misal berdasarkan user & event)
        $payment = Payment::where('user_id', auth()->id())
                          ->where('registration_id', $eventId)
                          ->first();

        if ($payment) {
            $payment->proof_of_payment = $path;
            $payment->save();
        }

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload!');
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