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
        $registration = RegistEvent::where('user_id', auth()->id())
            ->where('event_id', $eventId)
            ->first();
            
        if (!$registration) {
            return redirect()->back()->withErrors(['msg' => 'Registrasi event tidak ditemukan.']);
        }

        // Ambil event untuk mendapatkan harga
        $event = Event::findOrFail($eventId);

        // Ambil status "On Verification" dari tabel payment_statuses
        $status = PaymentStatus::where('name', 'On Verification')->first();
        if (!$status) {
            // Fallback atau error jika status 'On Verification' tidak ada
             $status = PaymentStatus::where('name', 'Pending')->first(); // Coba status 'Pending' jika 'On Verification' tidak ada
             if (!$status) {
                return redirect()->back()->withErrors(['msg' => 'Status pembayaran "On Verification" atau "Pending" tidak ditemukan. Harap jalankan seeder PaymentStatusSeeder.']);
             }
        }

        // Ambil payment_method_id default (Bank Transfer)
        $paymentMethod = PaymentMethod::where('name', 'Bank Transfer')->first();
        if (!$paymentMethod) {
            return redirect()->back()->withErrors(['msg' => 'Metode pembayaran tidak ditemukan.']);
        }

        // Simpan ke tabel payments
        Payment::updateOrCreate(
            [
                'registration_id' => $registration->id,
                'user_id' => auth()->id(),
            ],
            [
                'amount' => $event->price,
                'payment_method_id' => $paymentMethod->id,
                'payment_status_id' => $status->id,
                'proof_of_payment' => $path,
                'payment_date' => now(),
            ]
        );

        return redirect()->route('pembayaran.berhasil')->with('success', 'Bukti pembayaran berhasil diupload!');
    }

    // Tampilkan detail pembayaran dengan bukti bayar
    public function showProof(Payment $payment)
    {
        return view('payment_details', compact('payment'));
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

    // Tampilkan daftar pembayaran untuk verifikasi oleh admin
    public function verificationIndex(Request $request)
    {
        // Ambil status filter dari request
        $selectedStatuses = $request->input('status', []);

        // Query pembayaran dengan relasi
        $payments = Payment::with(['user', 'paymentStatus', 'registration.event'])
            ->orderBy('created_at', 'desc');

        // Terapkan filter berdasarkan status jika ada yang dipilih (selain 'all')
        if (!empty($selectedStatuses) && !in_array('all', $selectedStatuses)) {
            $payments->whereHas('paymentStatus', function ($query) use ($selectedStatuses) {
                $query->whereIn('name', $selectedStatuses);
            });
        }

        $payments = $payments->get();

        return view('verifbayar', compact('payments', 'selectedStatuses')); // Kirim juga status yang dipilih ke view
    }

    // Setujui Pembayaran (Admin)
    public function acceptPayment(Payment $payment)
    {
        // Temukan status 'Paid'
        $paidStatus = PaymentStatus::where('name', 'Paid')->first();

        if (!$paidStatus) {
            // Jika status 'Paid' tidak ditemukan, kembalikan error atau gunakan status default lain
            return redirect()->back()->withErrors(['msg' => 'Status pembayaran "Paid" tidak ditemukan. Harap jalankan seeder PaymentStatusSeeder.']);
        }

        // Perbarui status pembayaran
        $payment->payment_status_id = $paidStatus->id;
        $payment->save();

        // Redirect kembali ke halaman verifikasi dengan pesan sukses
        return redirect()->route('verifbayar')->with('success', 'Pembayaran berhasil disetujui!');
    }

    // Setujui Event (Admin)
    public function acceptEvent(Event $event)
    {
        // Temukan status 'Sudah Dikonfirmasi' atau status yang sesuai
        $approvedStatus = \App\Models\EventStatus::where('name', 'Sudah Dikonfirmasi')->first(); // Sesuaikan nama status approved Anda

        // Debugging: Periksa apakah status ditemukan
        // dd($approvedStatus);

        if (!$approvedStatus) {
            // Jika status 'Sudah Dikonfirmasi' tidak ditemukan
            return redirect()->back()->withErrors(['msg' => 'Status event "Sudah Dikonfirmasi" tidak ditemukan. Harap periksa tabel event_statuses.']);
        }

        // Perbarui status event
        $event->status_id = $approvedStatus->id;
        $event->save();

        // Redirect kembali ke halaman verifikasi dengan pesan sukses
        return redirect()->route('verification.event.index')->with('success', 'Event berhasil disetujui!');
    }

    // Notifikasi untuk relawan (verified payments)
    public function getVolunteerNotifications()
    {
        $verifiedPayments = Payment::with('registration.event') // Eager load relationships
                                   ->orderBy('updated_at', 'desc') // Order by latest update
                                   ->get(); // Get all payments

        return response()->json($verifiedPayments);
    }
} 