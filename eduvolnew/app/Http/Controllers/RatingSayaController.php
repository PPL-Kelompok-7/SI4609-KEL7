<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RatingSayaController extends Controller
{
    // Menampilkan daftar review yang dibuat user login
    public function index()
    {
        $userId = Auth::id();

        $reviews = DB::table('relawan_ratings as rr')
            ->join('events as e', 'rr.event_id', '=', 'e.id')
            ->where('rr.relawan_id', $userId)
            ->select(
                'rr.id',
                'e.title as event_title',
                DB::raw("CASE WHEN rr.rating_score IS NOT NULL THEN 'Sudah Dinilai' ELSE 'Belum Dinilai' END as status"),
                'rr.event_id'
            )
            ->orderByDesc('rr.created_at')
            ->get();

        return view('ratingsaya', ['reviews' => $reviews]);
    }

    // Menampilkan detail ulasan user login
    public function show($event_id)
    {
        $userId = Auth::id();

        $review = DB::table('relawan_ratings as rr')
            ->join('events as e', 'rr.event_id', '=', 'e.id')
            ->join('users as u', 'rr.relawan_id', '=', 'u.id')
            ->where('rr.relawan_id', $userId)
            ->where('rr.event_id', $event_id)
            ->select(
                DB::raw("CONCAT(u.first_name, ' ', u.last_name) as full_name"),
                'e.title as event_title',
                'rr.rating_score as rating',
                'rr.rating_description as ulasan',
                'rr.created_at'
            )
            ->first();

        if (!$review) {
            return redirect()->route('ratingsaya.index')->with('error', 'Ulasan tidak ditemukan.');
        }

        return view('ulasansaya', compact('review'));
    }
}
