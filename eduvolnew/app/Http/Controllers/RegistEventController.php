<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistEvent;
use App\Models\Payment;

class RegistEventController extends Controller
{
    public function create($eventId)
    {
        $user = auth()->user();
        return view('regist_event.create', [
            'eventId' => $eventId,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $registration = RegistEvent::create([
            'user_id' => auth()->id(),
            'event_id' => $request->event_id,
            'first_name' => auth()->user()->first_name,
            'last_name' => auth()->user()->last_name,
            'email' => auth()->user()->email,
            'mobile_phone' => $request->mobile_phone,
            'birth_date' => auth()->user()->birth_date,
            'family_status' => $request->keluarga,
            'handbook_agreement' => $request->handbook,
            'status' => 'pending',
            'registration_date' => now(),
        ]);

        Payment::create([
            'registration_id' => $registration->id,
            'amount' => $event->price,
            'payment_method_id' => 1, // atau sesuai input
            'payment_status_id' => 1, // default Unpaid
            // kolom lain jika perlu
        ]);

        return redirect()->route('pembayaran');
    }
}
