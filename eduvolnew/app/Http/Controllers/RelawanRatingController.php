<?php

namespace App\Http\Controllers;

use App\Models\RelawanRating;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RelawanRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = RelawanRating::with(['volunteer', 'rater', 'event'])->latest()->paginate(10);
        return view('relawan-ratings.index', compact('ratings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::all();
        $volunteers = User::where('role_id', 2)->get(); // Role ID 2 is for Volunteer
        return view('relawan-ratings.create', compact('events', 'volunteers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'volunteer_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        $validated['rater_id'] = Auth::id();

        RelawanRating::create($validated);

        return redirect()->route('relawan-ratings.index')
            ->with('success', 'Rating submitted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(RelawanRating $relawanRating)
    {
        return view('relawan-ratings.show', compact('relawanRating'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RelawanRating $relawanRating)
    {
        $this->authorize('update', $relawanRating);
        $events = Event::all();
        $volunteers = User::where('role_id', 2)->get();
        return view('relawan-ratings.edit', compact('relawanRating', 'events', 'volunteers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RelawanRating $relawanRating)
    {
        $this->authorize('update', $relawanRating);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        $relawanRating->update($validated);

        return redirect()->route('relawan-ratings.index')
            ->with('success', 'Rating updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RelawanRating $relawanRating)
    {
        $this->authorize('delete', $relawanRating);
        
        $relawanRating->delete();

        return redirect()->route('relawan-ratings.index')
            ->with('success', 'Rating deleted successfully');
    }
}
