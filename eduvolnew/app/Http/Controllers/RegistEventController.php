<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistEvent;

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
        RegistEvent::create([
            'user_id' => $user->id,
            'event_id' => $request->event_id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'mobile_phone' => $request->mobile_phone,
            'birth_date' => $user->birth_date,
            'voucher_id' => $request->voucher_id,
            'status' => 'pending',
            'registration_date' => now(),
        ]);
        return redirect()->route('event.success');
    }
}
