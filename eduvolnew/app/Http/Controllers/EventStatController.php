<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class EventStatController extends Controller
{
    public function showTopUsers()
    {
        $topUsers = DB::table('users as u')
            ->join('regist_event as r', 'u.id', '=', 'r.user_id')
            ->select(
                'u.id',
                DB::raw("CONCAT(u.first_name, ' ', u.last_name) as full_name"),
                DB::raw('COUNT(r.event_id) as total_events')
            )
            ->groupBy('u.id', 'u.first_name', 'u.last_name')
            ->orderByDesc('total_events')
            ->limit(3)
            ->get();

        return view('topusers', ['topUsers' => $topUsers]);
    }
}
