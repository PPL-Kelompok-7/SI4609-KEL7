<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilestoneController extends Controller
{
    public function updateTarget(Request $request)
    {
        $request->validate([
            'target_hours' => 'required|integer|min:1'
        ]);
        $user = Auth::user();
        $user->target_hours = $request->target_hours;
        $user->save();

        return redirect()->route('profile')->with('success', 'Target hours updated!');
    }
}
