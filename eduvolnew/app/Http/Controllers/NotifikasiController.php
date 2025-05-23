<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\RegistEvent;
use App\Models\Payment;
use App\Models\PaymentStatus;

class NotifikasiController extends Controller
{
    public function index()
    {
        // Ambil semua pendaftaran relawan dari tabel regist_event dan eager load relasi event
        $notifications = RegistEvent::with(['event'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($reg) {
                return (object) [
                    'volunteer_name' => $reg->first_name . ' ' . $reg->last_name,
                    'event_title' => optional($reg->event)->title,
                    'event_id' => $reg->event_id,
                    'created_at' => $reg->created_at,
                    // Kita tidak lagi memuat status pembayaran spesifik dari tabel payment
                ];
            });
            
        return view('notifikasi', compact('notifications'));
    }
} 