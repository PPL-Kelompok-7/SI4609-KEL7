<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
{
    $total_users = DB::table('regist_event')->distinct('user_id')->count('user_id');
    $total_events = DB::table('events')->count();

    // Ambil 3 volunteer teratas berdasarkan jumlah event yang diikuti
    $topVolunteers = DB::table('regist_event')
        ->join('users', 'regist_event.user_id', '=', 'users.id')
        ->select(
            'users.id',
            'users.email',
            DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"),
            'users.profile_photo',
            DB::raw('COUNT(regist_event.event_id) as event_count')
        )
        ->groupBy('regist_event.user_id', 'users.id', 'users.email', 'users.first_name', 'users.last_name', 'users.profile_photo')
        ->orderByDesc('event_count')
        ->limit(3)
        ->get();

    return view('landingpage', compact('total_users', 'total_events', 'topVolunteers'));
}


}
