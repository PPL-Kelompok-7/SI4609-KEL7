<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\RegistEvent;
use Illuminate\Support\Facades\Auth;

class HistoryKegiatanController extends Controller
{
    public function index(Request $request) {
        $user  = Auth::user();
        $registrations = RegistEvent::where('user_id', $user->id)
            ->with(['event'])
            ->get();

        $status = $request->input('status');
        $events = Event::with('status')
            ->when($status, function($query) use ($status) {
                $query->whereHas('status', function($q) use ($status) {
                    $q->whereIn('name', (array)$status);
                });
            })
            ->get();

        return view('historykegiatan', compact('registrations', 'events'));
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
