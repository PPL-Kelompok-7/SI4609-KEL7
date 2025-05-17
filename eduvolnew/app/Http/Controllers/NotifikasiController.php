<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\RegistEvent;

class NotifikasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ambil event yang dibuat oleh user (mitra)
        $eventIds = Event::where('created_by', $user->id)->pluck('id');
        // Ambil pendaftaran relawan ke event-event tersebut
        $notifications = RegistEvent::whereIn('event_id', $eventIds)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($reg) {
                return (object) [
                    'volunteer_name' => $reg->first_name . ' ' . $reg->last_name,
                    'event_title' => optional($reg->event)->title,
                    'event_id' => $reg->event_id,
                    'created_at' => $reg->created_at,
                ];
            });
        return view('notifikasi', compact('notifications'));
    }
} 