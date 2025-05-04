<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function create()
    {
        $statuses = EventStatus::all();
        return view('events.create', compact('statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'terms' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
            'max_participants' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'event_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_id' => 'required|exists:event_statuses,id'
        ]);

        // Handle photo upload
        if ($request->hasFile('event_photo')) {
            $path = $request->file('event_photo')->store('event-photos', 'public');
            $validated['event_photo'] = $path;
        }

        $validated['created_by'] = Auth::id();

        Event::create($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully');
    }

    public function edit(Event $event)
    {
        $statuses = EventStatus::all();
        return view('events.edit', compact('event', 'statuses'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'terms' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
            'max_participants' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'event_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_id' => 'required|exists:event_statuses,id'
        ]);

        // Handle photo upload
        if ($request->hasFile('event_photo')) {
            // Delete old photo if exists
            if ($event->event_photo && Storage::disk('public')->exists($event->event_photo)) {
                Storage::disk('public')->delete($event->event_photo);
            }
            
            $path = $request->file('event_photo')->store('event-photos', 'public');
            $validated['event_photo'] = $path;
        }

        $event->update($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully');
    }
} 