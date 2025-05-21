<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Event;
use App\Models\EventStatus;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EventTest extends DuskTestCase
{
    // Hapus use DatabaseMigrations karena kita tidak akan menggunakan migration
    // use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        // Hapus migrate:fresh dan db:seed karena kita menggunakan database yang diimport
        // $this->artisan('migrate:fresh');
        // $this->artisan('db:seed');
    }

    /**
     * Test Case: TC.Event.001
     * Test: Menguji fungsionalitas halaman List Event (Positif)
     */
    public function test_user_can_view_event_list()
    {
        // Gunakan user pertama yang ada di database
        $user = User::first();
        if (!$user) {
            $this->markTestSkipped('Tidak ada user di database');
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                   ->visit('/events')
                   ->assertSee('Event Volunteer')
                   ->assertSee('Ikut Partisipasi');
        });
    }

    /**
     * Test Case: TC.Event.002
     * Test: Menguji error saat mengakses List Event (Negatif)
     */
    public function test_guest_cannot_view_event_list()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/events')
                   ->assertPathIs('/login')
                   ->assertSee('Login');
        });
    }

    /**
     * Test Case: TC.Event.001
     * Test: Menguji fungsionalitas halaman Detail Event (Positif)
     */
    public function test_user_can_view_event_detail()
    {
        // Gunakan user pertama yang ada di database
        $user = User::first();
        if (!$user) {
            $this->markTestSkipped('Tidak ada user di database');
        }

        // Ambil event pertama yang ada di database
        $event = Event::first();
        if (!$event) {
            $this->markTestSkipped('Tidak ada event di database');
        }

        $this->browse(function (Browser $browser) use ($user, $event) {
            $browser->loginAs($user)
                   ->visit('/events')
                   ->click('a[href="' . url('/event-detail/' . $event->id) . '"]')
                   ->assertSee($event->title)
                   ->assertSee($event->description)
                   ->assertSee($event->location);
        });
    }

    /**
     * Test Case: TC.Event.002
     * Test: Menguji error saat membuka detail event yang tidak ada (Negatif)
     */
    public function test_user_cannot_view_nonexistent_event()
    {
        // Gunakan user pertama yang ada di database
        $user = User::first();
        if (!$user) {
            $this->markTestSkipped('Tidak ada user di database');
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                   ->visit('/event-detail/999999')
                   ->assertSee('Event tidak ditemukan');
        });
    }

    /**
     * Test Case: TC.Event.001
     * Test: Menguji fungsionalitas Homepage (Posting Event) (Positif)
     */
    public function test_user_can_create_event()
    {
        // Gunakan user pertama yang ada di database
        $user = User::first();
        if (!$user) {
            $this->markTestSkipped('Tidak ada user di database');
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                   ->visit('/formposting-event')
                   ->type('nama_event', 'New Test Event')
                   ->type('deskripsi_event', 'New Test Description')
                   ->type('tanggal_event', now()->format('Y-m-d'))
                   ->type('jam_mulai', '09:00')
                   ->type('jam_berakhir', '17:00')
                   ->type('lokasi', 'New Test Location')
                   ->type('kebutuhan_volunteer', '10')
                   ->type('nominal_tiket', '0')
                   ->check('agreement')
                   ->press('Submit')
                   ->assertPathIs('/event-registered')
                   ->assertSee('New Test Event');
        });
    }

    /**
     * Test Case: TC.Event.002
     * Test: Menguji fungsionalitas Homepage (Posting Event) (Negatif)
     */
    public function test_user_cannot_create_event_with_invalid_data()
    {
        // Gunakan user pertama yang ada di database
        $user = User::first();
        if (!$user) {
            $this->markTestSkipped('Tidak ada user di database');
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                   ->visit('/formposting-event')
                   ->press('Submit')
                   ->assertSee('The nama event field is required')
                   ->assertSee('The deskripsi event field is required')
                   ->assertSee('The tanggal event field is required')
                   ->assertSee('The jam mulai field is required')
                   ->assertSee('The jam berakhir field is required')
                   ->assertSee('The lokasi field is required')
                   ->assertSee('The kebutuhan volunteer field is required');
        });
    }
} 