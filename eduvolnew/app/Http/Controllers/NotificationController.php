<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment; // Assuming you have a Payment model
use App\Models\Registration; // Assuming you need Registration for event title

class NotificationController extends Controller
{
    public function showVolunteerNotifications()
    {
        // Fetch payments for the authenticated user
        // Eager load the registration and event relationships if needed for event title
        $payments = Payment::where('user_id', auth()->id())
                           ->with(['registration.event'])
                           // Filter by payment_status_id for 'Terverifikasi'
                           ->where('payment_status_id', 2) // Assuming 2 is the ID for 'Terverifikasi'
                           ->orderBy('payment_date', 'desc') // Or updated_at
                           ->get();

        // Removed the commented out section as we are now using the filter directly.
        // You might want to filter by payment_status_id if you only want 'Terverifikasi' (e.g., where('payment_status_id', 2))
        // $payments = Payment::where('user_id', auth()->id())
        //                    ->where('payment_status_id', 2) // Assuming 2 is the ID for 'Terverifikasi'
        //                    ->with(['registration.event'])
        //                    ->orderBy('payment_date', 'desc')
        //                    ->get();


        return view('notifikasi_relawan', compact('payments'));
    }

    // You might also need a method to mark notifications as read, but that's beyond the current scope.
} 