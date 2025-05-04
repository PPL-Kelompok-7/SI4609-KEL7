<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\RegistEvent;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Tampilkan form pembayaran
    public function show($registrationId)
    {
        $registration = RegistEvent::findOrFail($registrationId);
        $payment = Payment::where('registration_id', $registrationId)->first();
        $methods = PaymentMethod::all();
        return view('pembayaran', compact('registration', 'payment', 'methods'));
    }

    // Proses upload bukti bayar
    public function uploadProof(Request $request, $paymentId)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ]);
        $payment = Payment::findOrFail($paymentId);
        if ($request->hasFile('proof_of_payment')) {
            $path = $request->file('proof_of_payment')->store('payments', 'public');
            $payment->proof_of_payment = $path;
            $payment->payment_status_id = PaymentStatus::where('name', 'On Verification')->first()->id;
            $payment->save();
        }
        return redirect()->route('payments.show', $payment->registration_id)->with('success', 'Bukti pembayaran berhasil diupload!');
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