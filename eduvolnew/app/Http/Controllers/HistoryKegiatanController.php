<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\RegistEvent;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class HistoryKegiatanController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        
        // Get paid payments for the current user
        $paidPayments = Payment::where('user_id', $user->id)
                               ->where('payment_status_id', 3) // Assuming 3 is the ID for 'paid'
                               ->with('event') // Eager load the related event
                               ->get();

        // Extract events from paid payments
        $events = $paidPayments->map(function ($payment) {
            return $payment->event;
        })->filter(function($event) { return $event !== null; }); // Filter out any null events if relationship fails

        // Filter events by search term if present
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $events = $events->filter(function ($event) use ($searchTerm) {
                return stripos($event->title, $searchTerm) !== false;
            });
        }

        // Filter events based on status if status filter is applied
        if ($request->has('status')) {
            $now = now();
            $events = $events->filter(function ($event) use ($request, $now) {
                // Ensure only date part is taken from start_date/end_date
                $startDate = \Carbon\Carbon::parse($event->start_date)->format('Y-m-d');
                $endDate = \Carbon\Carbon::parse($event->end_date)->format('Y-m-d');

                $startDateTime = \Carbon\Carbon::parse($startDate . ' ' . $event->start_time);
                $endDateTime = \Carbon\Carbon::parse($endDate . ' ' . $event->end_time);

                // Debugging: Check the time values and comparison
                // dd(['event_id' => $event->id, 'now' => $now, 'start' => $startDateTime, 'end' => $endDateTime, 'event_title' => $event->title]);
                
                $status = '';
                if ($now < $startDateTime) {
                    $status = 'coming soon';
                } elseif ($now >= $startDateTime && $now <= $endDateTime) {
                    $status = 'ongoing';
                } else {
                    $status = 'ended';
                }
                
                return in_array($status, $request->status);
            });
        }

        return view('historykegiatan', ['events' => $events]);
    }

    public function show($id) {
        $registration = RegistEvent::with(['event'])->findOrFail($id);
        return view('historykegiatan.show', compact('registration'));
    }

    public function store(Request $request) {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'nomor_handphone' => 'required',
            'keluarga' => 'required',
            'handbook' => 'required'
        ]);

        $registration = new RegistEvent();
        $registration->user_id = Auth::id();
        $registration->event_id = $request->event_id;
        $registration->nomor_handphone = $request->nomor_handphone;
        $registration->family_status = $request->keluarga;
        $registration->handbook_agreement = $request->handbook;
        $registration->status = 'on_going'; // Atur status sesuai kebutuhan
        $registration->save();

        return redirect()->route('history-kegiatan.index')
            ->with('success', 'Anda berhasil mendaftar event!');
    }
}