<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status event menjadi Coming Soon, Ongoing, dan Ended secara otomatis berdasarkan tanggal event.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // 1. Update status event
        // Ended (id = 9)
        $ended = Event::where('end_date', '<', $now)
            ->where('status_id', '!=', 9)
            ->update(['status_id' => 9]);

        // Ongoing (id = 3)
        $ongoing = Event::where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->where('status_id', '!=', 3)
            ->update(['status_id' => 3]);

        // Coming Soon (id = 8)
        $comingSoon = Event::where('start_date', '>', $now)
            ->where('status_id', '!=', 8)
            ->update(['status_id' => 8]);

        // 2. Otomatisasi teaching_sessions untuk event yang baru saja ended
        // Ambil semua event yang status_id = 9 (ended)
        $endedEvents = Event::where('status_id', 9)->get();

        foreach ($endedEvents as $event) {
            // Cek user yang sudah paid & ikut event ini
            $userIds = DB::table('regist_event')
                ->join('payments', 'regist_event.id', '=', 'payments.registration_id')
                ->where('regist_event.event_id', $event->id)
                ->where('payments.payment_status_id', 3)
                ->pluck('regist_event.user_id');

            foreach ($userIds as $userId) {
                // Cek teaching_session sudah ada untuk user & event ini (gunakan end_date sebagai acuan tanggal)
                $exists = DB::table('teaching_sessions')
                    ->where('user_id', $userId)
                    ->whereDate('created_at', $event->end_date)
                    ->exists();

                if (!$exists) {
                    DB::table('teaching_sessions')->insert([
                        'user_id' => $userId,
                        'duration' => $event->duration ?? 1, // gunakan duration event jika ada, default 1
                        'created_at' => $event->end_date,
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        $this->info("Updated $ended events to Ended, $ongoing to Ongoing, $comingSoon to Coming Soon, and teaching_sessions updated.");
    }
}