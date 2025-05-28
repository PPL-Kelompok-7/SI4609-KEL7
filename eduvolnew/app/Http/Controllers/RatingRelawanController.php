<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingRelawanController extends Controller
{
    // Menampilkan daftar relawan yang sudah ikut event selesai
    public function index()
    {
        $relawanList = DB::table('users as u')
            ->join('regist_event as r', 'u.id', '=', 'r.user_id')
            ->join('payments as p', 'r.id', '=', 'p.registration_id')
            ->join('events as e', 'r.event_id', '=', 'e.id')
            ->join('payment_statuses as ps', 'p.payment_status_id', '=', 'ps.id')
            ->join('event_statuses as es', 'e.status_id', '=', 'es.id')
            ->where('p.payment_status_id', 3) // Sudah bayar
            ->where('e.status_id', 9)         // Event selesai
            ->select(
                'u.id as user_id',
                DB::raw("CONCAT(u.first_name, ' ', u.last_name) as full_name"),
                'e.id as event_id',
                'e.title as event_title'
            )
            ->orderByDesc('e.end_date')
            ->get();

        foreach ($relawanList as $relawan) {
            $alreadyRated = DB::table('relawan_ratings')
                ->where('relawan_id', $relawan->user_id)
                ->where('event_id', $relawan->event_id)
                ->exists();

            $relawan->status = $alreadyRated ? 'Sudah Dinilai' : 'Belum Dinilai';
        }

        return view('ratingrelawan', ['ratings' => $relawanList]);
    }

    // Menampilkan form untuk memberikan rating
    public function create($relawan_id, $event_id)
    {
        $relawan = DB::table('users')->where('id', $relawan_id)->first();
        $event = DB::table('events')->where('id', $event_id)->first();

        // Jika rating sudah pernah diberikan, redirect kembali
        $alreadyRated = DB::table('relawan_ratings')
            ->where('relawan_id', $relawan_id)
            ->where('event_id', $event_id)
            ->exists();

        if ($alreadyRated) {
            return redirect()->route('ratingrelawan')->with('error', 'Relawan ini sudah dinilai.');
        }

        return view('formratingrelawan', [
            'relawan' => $relawan,
            'event' => $event,
            'event_id' => $event_id
        ]);
    }

    // Menyimpan rating ke database
    public function store(Request $request)
    {
        $request->validate([
            'relawan_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'rating_score' => 'required|integer|between:1,10',
            'rating_description' => 'required|string'
        ]);

        DB::table('relawan_ratings')->insert([
            'relawan_id' => $request->relawan_id,
            'event_id' => $request->event_id,
            'rating_score' => $request->rating_score,
            'rating_description' => $request->rating_description,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $relawan = DB::table('users')->where('id', $request->relawan_id)->first();
        $event = DB::table('events')->where('id', $request->event_id)->first(); // ✅ Ambil data event

        return view('formratingrelawan', [
            'relawan' => $relawan,
            'event' => $event,
            'event_id' => $request->event_id,
            'success' => "Berhasil memberikan ulasan pada {$relawan->first_name}"
        ]);
    }

    public function showReview($relawan_id, $event_id)
    {
        $review = DB::table('relawan_ratings')
        ->join('users', 'relawan_ratings.relawan_id', '=', 'users.id')
        ->join('events', 'relawan_ratings.event_id', '=', 'events.id')
        ->where('relawan_ratings.relawan_id', $relawan_id)
        ->where('relawan_ratings.event_id', $event_id)
        ->select(
            DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"),
            'events.title as event_title',
            'relawan_ratings.rating_score as rating',
            'relawan_ratings.rating_description as ulasan',
            'relawan_ratings.created_at'
        )
        ->first();


        if (!$review) {
            return redirect()->route('ratingrelawan')->with('error', 'Ulasan tidak ditemukan.');
        }

        return view('lihatreviewrelawan', compact('review'));
    }

}
