<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RatingSayaTest extends DuskTestCase
{
    // Gunakan jika kamu pakai migrasi
    // use DatabaseMigrations;

    public function test_rating_saya_workflow()
    {
        $this->browse(function (Browser $browser) {
            try {
                $browser
                    ->visit('/')
                    ->pause(1000)
                    ->clickLink('Sign Up/Log In')
                    ->waitForLocation('/login', 10)
                    ->type('email', 'test4@gmail.com')
                    ->type('password', 'password123')
                    ->press('Masuk')
                    ->waitForLocation('/home', 10)
                    ->pause(1000)

                    // Masuk ke halaman history kegiatan
                    ->click('a[href*="history-kegiatan"]')
                    ->waitForLocation('/history-kegiatan', 10)

                    // Klik link "Rating Saya"
                    ->clickLink('Rating Saya')
                    ->waitForLocation('/ratingsaya', 10)
                    ->pause(2000)

                    // Screenshot sebelum klik ulasan
                    ->screenshot('before-ulasan-click')

                    // Pastikan tombol ulasan pertama ada
                    ->assertPresent('[data-dusk="lihat-rating-0"]')
                    ->assertVisible('[data-dusk="lihat-rating-0"]')

                    // Scroll ke elemen dan tekan tombol
                    ->scrollIntoView('[data-dusk="lihat-rating-0"]')
                    ->pause(1000)
                    ->press('[data-dusk="lihat-rating-0"]') // Diganti dari click ke press

                    ->pause(3000)

                    // Screenshot sesudah klik
                    ->screenshot('after-ulasan-click');

            } catch (\Exception $e) {
                // Ambil HTML & screenshot jika error
                $html = $browser->driver->getPageSource();
                file_put_contents(storage_path('app/dusk-errors/ratingsaya-error.html'), $html);
                $browser->screenshot('ratingsaya-error');
                throw $e;
            }
        });
    }
}
