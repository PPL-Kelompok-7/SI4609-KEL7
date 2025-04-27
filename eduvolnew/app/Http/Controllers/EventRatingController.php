<?php

namespace App\Http\Controllers;

use App\Models\EventRating;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = EventRating::with(['user', 'event'])->latest()->paginate(10);
        return view('event-ratings.index', compact('ratings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::all();
        return view('event-ratings.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        $validated['user_id'] = Auth::id();

        EventRating::create($validated);

        return redirect()->route('event-ratings.index')
            ->with('success', 'Rating submitted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventRating $eventRating)
    {
        return view('event-ratings.show', compact('eventRating'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventRating $eventRating)
    {
        $this->authorize('update', $eventRating);
        $events = Event::all();
        return view('event-ratings.edit', compact('eventRating', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventRating $eventRating)
    {
        $this->authorize('update', $eventRating);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        $eventRating->update($validated);

        return redirect()->route('event-ratings.index')
            ->with('success', 'Rating updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventRating $eventRating)
    {
        $this->authorize('delete', $eventRating);
        
        $eventRating->delete();

        return redirect()->route('event-ratings.index')
            ->with('success', 'Rating deleted successfully');
    }
}
