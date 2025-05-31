<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon; // Import Carbon untuk perbandingan tanggal

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
        $now = now();
        $oneDayAfter = $now->copy()->addDay();
        
        $events = \App\Models\Event::whereIn('status_id', [3, 7, 8])
            ->where(function($query) use ($now, $oneDayAfter) {
                $query->where('end_date', '>=', $now)
                      ->orWhere(function($q) use ($now, $oneDayAfter) {
                          $q->where('end_date', '>=', $now->copy()->subDay())
                            ->where('end_date', '<=', $oneDayAfter);
                      });
            })
            ->orderBy('start_date', 'asc')
            ->get()
            ->map(function($event) {
                return [
                    'id'    => $event->id,
                    'event_photo' => $event->event_photo,
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

    // Method untuk menampilkan detail event untuk mitra
    public function showMitra($id)
    {
        $event = Event::findOrFail($id);
        // Format tanggal dan jam
        $tanggal = \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y');
        $jam = $event->start_time . ' - ' . $event->end_time;
        $harga = $event->price > 0 ? 'Rp' . number_format($event->price,0,',','.') : 'Gratis';
        return view('detailevent_mitra', [
            'event' => $event,
            'tanggal' => $tanggal,
            'jam' => $jam,
            'harga' => $harga
        ]);
    }

    public function postingEventIndex()
    {
        $events = Event::whereIn('status_id', [1, 7])->get()->map(function($event) {
            // Menggunakan Carbon untuk perbandingan tanggal
            $now = Carbon::now();
            $eventEndDate = Carbon::parse($event->end_date);

            $status = 'coming-soon';
            // Periksa status_id terlebih dahulu untuk event yang dikonfirmasi
            if ($event->status_id == 7) { // If event is confirmed
                 // Menggunakan betweenInclusive jika perlu mencakup tanggal mulai dan berakhir
                if ($now->between($event->start_date, $event->end_date)) {
                    $status = 'on-going';
                } elseif ($now->gt($eventEndDate)) { // Menggunakan gt untuk tanggal yang sudah lewat
                    $status = 'ended';
                } else { // Jika sudah dikonfirmasi tapi belum on-going atau ended, berarti coming-soon
                    $status = 'coming-soon';
                }
            } else { // Jika belum dikonfirmasi, selalu coming-soon di halaman posting event
                 $status = 'coming-soon';
            }

            return [
                'id' => $event->id,
                'title' => $event->title,
                'status_id' => $event->status_id, // Tetap sertakan status_id
                'status' => $status,
                'date' => $event->end_date // Sertakan end_date untuk perbandingan di view
            ];
        });

        // Count events by status
        $statusCounts = [
            'on-going' => $events->where('status', 'on-going')->count(),
            'coming-soon' => $events->where('status', 'coming-soon')->count(),
            'ended' => $events->where('status', 'ended')->count()
        ];

        return view('posting-event', [
            'events' => $events,
            'statusCounts' => $statusCounts
        ]);
    }

    // Menampilkan daftar event yang perlu diverifikasi (untuk admin)
    public function verificationIndex(Request $request)
    {
        // Ambil status filter dari request
        $selectedStatuses = $request->input('status', []);

        // Query event dengan relasi status
        $events = \App\Models\Event::with('status')
            ->orderBy('created_at', 'desc');

        // Terapkan filter berdasarkan status jika ada yang dipilih (selain 'all')
        if (!empty($selectedStatuses) && !in_array('all', $selectedStatuses)) {
            $events->whereHas('status', function ($query) use ($selectedStatuses) {
                $query->whereIn('name', $selectedStatuses);
            });
        }

        $events = $events->get();

        return view('verifevent', compact('events', 'selectedStatuses')); // Kirim juga status yang dipilih ke view
    }

    // Setujui Event (Admin)
    public function acceptEvent(Event $event)
    {
        // Temukan status 'Sudah Dikonfirmasi' atau status yang sesuai
        $approvedStatus = \App\Models\EventStatus::where('name', 'Sudah Dikonfirmasi')->first(); // Sesuaikan nama status approved Anda

        // Debugging: Periksa apakah status ditemukan
        // dd($approvedStatus);

        if (!$approvedStatus) {
            // Jika status 'Sudah Dikonfirmasi' tidak ditemukan
            return redirect()->back()->withErrors(['msg' => 'Status event "Sudah Dikonfirmasi" tidak ditemukan. Harap periksa tabel event_statuses.']);
        }

        // Perbarui status event
        $event->status_id = $approvedStatus->id;
        $event->save();

        // Redirect kembali ke halaman verifikasi dengan pesan sukses
        return redirect()->route('verification.event.index')->with('success', 'Event berhasil disetujui!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        
        // Optional: Hapus juga event photo dari storage jika ada
        if ($event->event_photo && Storage::disk('public')->exists($event->event_photo)) {
            Storage::disk('public')->delete($event->event_photo);
        }

        $event->delete();

        return redirect()->route('posting-event.index')->with('success', 'Event berhasil dihapus.');
    }
}