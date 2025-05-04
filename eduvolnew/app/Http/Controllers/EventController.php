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
        return view('formposting-event');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_event' => 'required|string|max:255',
            'tanggal_event' => 'required|date',
            'jam_mulai' => 'required',
            'jam_berakhir' => 'required',
            'kebutuhan_volunteer' => 'required|integer|min:1',
            'lokasi' => 'required|string|max:255',
            'deskripsi_event' => 'required|string',
            'nominal_tiket' => 'nullable|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg|max:10240',
            'agreement' => 'accepted'
        ]);

        $event = new Event();
        $event->title = $request->nama_event;
        $event->description = $request->deskripsi_event;
        $event->terms = 'Syarat dan ketentuan berlaku'; // Atur sesuai kebutuhan
        $event->start_date = $request->tanggal_event;
        $event->end_date = $request->tanggal_event;
        $event->start_time = $request->jam_mulai;
        $event->end_time = $request->jam_berakhir;
        $event->location = $request->lokasi;
        $event->max_participants = $request->kebutuhan_volunteer;
        $event->price = $request->nominal_tiket ?? 0;
        $event->status_id = 1; // Atur default status
        $event->created_by = auth()->id() ?? 1; // Atur sesuai user login

        // Upload foto
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('event_photos', 'public');
            $event->event_photo = $path;
        }

        $event->save();

        return view('event-registered', ['eventTitle' => $event->title]);
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

    public function index()
    {
        $events = \App\Models\Event::all()->map(function($event) {
            return [
                'id'    => $event->id,
                'image' => $event->event_photo ? 'storage/' . $event->event_photo : 'images/default-event.png',
                'title' => $event->title,
                'price' => $event->price > 0 ? 'Rp ' . number_format($event->price,0,',','.') : 'Free',
                'date'  => \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y'),
            ];
        });
        return view('event', ['events' => $events]);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        // Format tanggal dan jam
        $tanggal = \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y');
        $jam = $event->start_time . ' - ' . $event->end_time;
        $harga = $event->price > 0 ? 'Rp' . number_format($event->price,0,',','.') : 'Gratis';
        return view('event-detail', [
            'event' => $event,
            'tanggal' => $tanggal,
            'jam' => $jam,
            'harga' => $harga
        ]);
    }
} 