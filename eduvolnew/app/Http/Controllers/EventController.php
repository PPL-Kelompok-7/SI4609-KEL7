<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'agreement' => 'accepted'
        ]);

        $event = new Event();
        $event->title = $request->nama_event;
        $event->description = $request->deskripsi_event;
        $event->terms = 'Syarat dan ketentuan berlaku';
        $event->start_date = $request->tanggal_event;
        $event->end_date = $request->tanggal_event;
        $event->start_time = $request->jam_mulai;
        $event->end_time = $request->jam_berakhir;
        $event->location = $request->lokasi;
        $event->max_participants = $request->kebutuhan_volunteer;
        $event->price = $request->nominal_tiket ?? 0;
        $event->status_id = 1;
        $event->created_by = auth()->id() ?? 1;

        if ($request->hasFile('thumbnail')) {
            $filename = time() . '_' . $request->file('thumbnail')->getClientOriginalName();

            $destinationPath = public_path('images/fotoevent');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $request->file('thumbnail')->move($destinationPath, $filename);
            $event->event_photo = 'images/fotoevent/' . $filename;
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
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
            'max_participants' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'event_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_id' => 'required|exists:event_statuses,id'
        ]);

        if ($request->hasFile('event_photo')) {
            // Hapus file lama jika ada
            if ($event->event_photo && file_exists(public_path($event->event_photo))) {
                unlink(public_path($event->event_photo));
            }

            $filename = time() . '_' . $request->file('event_photo')->getClientOriginalName();

            $destinationPath = public_path('images/fotoevent');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $request->file('event_photo')->move($destinationPath, $filename);
            $validated['event_photo'] = 'images/fotoevent/' . $filename;
        }

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    public function index()
    {
        $now = now();
        $oneDayAfter = $now->copy()->addDay();

        $events = Event::whereIn('status_id', [3, 7, 8])
            ->where(function ($query) use ($now, $oneDayAfter) {
                $query->where('end_date', '>=', $now)
                    ->orWhere(function ($q) use ($now, $oneDayAfter) {
                        $q->where('end_date', '>=', $now->copy()->subDay())
                          ->where('end_date', '<=', $oneDayAfter);
                    });
            })
            ->orderBy('start_date', 'asc')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'event_photo' => $event->event_photo,
                    'title' => $event->title,
                    'price' => $event->price > 0 ? 'Rp ' . number_format($event->price, 0, ',', '.') : 'Free',
                    'date' => Carbon::parse($event->start_date)->translatedFormat('d F Y'),
                ];
            });

        return view('event', ['events' => $events]);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        $tanggal = Carbon::parse($event->start_date)->translatedFormat('d F Y');
        $jam = $event->start_time . ' - ' . $event->end_time;
        $harga = $event->price > 0 ? 'Rp' . number_format($event->price, 0, ',', '.') : 'Gratis';

        return view('event-detail', compact('event', 'tanggal', 'jam', 'harga'));
    }

    public function showMitra($id)
    {
        $event = Event::findOrFail($id);
        $tanggal = Carbon::parse($event->start_date)->translatedFormat('d F Y');
        $jam = $event->start_time . ' - ' . $event->end_time;
        $harga = $event->price > 0 ? 'Rp' . number_format($event->price, 0, ',', '.') : 'Gratis';

        return view('detailevent_mitra', compact('event', 'tanggal', 'jam', 'harga'));
    }

    public function postingEventIndex()
    {
        $events = Event::whereIn('status_id', [1, 7])->get()->map(function ($event) {
            $now = Carbon::now();
            $eventEndDate = Carbon::parse($event->end_date);
            $status = 'coming-soon';

            if ($event->status_id == 7) {
                if ($now->between($event->start_date, $event->end_date)) {
                    $status = 'on-going';
                } elseif ($now->gt($eventEndDate)) {
                    $status = 'ended';
                } else {
                    $status = 'coming-soon';
                }
            }

            return [
                'id' => $event->id,
                'title' => $event->title,
                'status_id' => $event->status_id,
                'status' => $status,
                'date' => $event->end_date
            ];
        });

        $statusCounts = [
            'on-going' => $events->where('status', 'on-going')->count(),
            'coming-soon' => $events->where('status', 'coming-soon')->count(),
            'ended' => $events->where('status', 'ended')->count()
        ];

        return view('posting-event', compact('events', 'statusCounts'));
    }

    public function verificationIndex(Request $request)
    {
        $selectedStatuses = $request->input('status', []);

        $events = Event::with('status')->orderBy('created_at', 'desc');

        if (!empty($selectedStatuses) && !in_array('all', $selectedStatuses)) {
            $events->whereHas('status', function ($query) use ($selectedStatuses) {
                $query->whereIn('name', $selectedStatuses);
            });
        }

        $events = $events->get();

        return view('verifevent', compact('events', 'selectedStatuses'));
    }

    public function acceptEvent(Event $event)
    {
        $approvedStatus = EventStatus::where('name', 'Sudah Dikonfirmasi')->first();

        if (!$approvedStatus) {
            return redirect()->back()->withErrors(['msg' => 'Status event "Sudah Dikonfirmasi" tidak ditemukan. Harap periksa tabel event_statuses.']);
        }

        $event->status_id = $approvedStatus->id;
        $event->save();

        return redirect()->route('verification.event.index')->with('success', 'Event berhasil disetujui!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->event_photo && file_exists(public_path($event->event_photo))) {
            unlink(public_path($event->event_photo));
        }

        $event->delete();

        return redirect()->route('posting-event.index')->with('success', 'Event berhasil dihapus');
    }
}
