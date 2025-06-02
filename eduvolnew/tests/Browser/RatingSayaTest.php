<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class RatingSayaTest extends DuskTestCase
{
    public function testLangsungKeHalamanRatingSaya()
    {
        $this->browse(function (Browser $browser) {
            try {
                // Login sebagai user dengan ID 1 (pastikan user ini ada di tabel `users`)
                $user = User::find(1); // Ganti ID sesuai user yang valid
                $browser->loginAs($user)
                    ->visit('/ratingsaya')
                    ->pause(2000)
                    ->assertPathIs('/ratingsaya')
                    ->screenshot('ratingsaya-halaman');

            } catch (\Exception $e) {
                $html = $browser->driver->getPageSource();
                file_put_contents(storage_path('app/dusk-errors/ratingsaya-error.html'), $html);
                $browser->screenshot('ratingsaya-error');
                throw $e;
            }
        });
    }
}
