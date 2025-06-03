<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LihatRatingTest extends DuskTestCase
{
    public function testLangsungKeHalamanLihatRating()
    {
        $this->browse(function (Browser $browser) {
            try {
                // Login sebagai user dengan ID 1 (pastikan user ini ada di tabel `users`)
                $user = User::find(1); // Sesuaikan ID dengan user valid

                $browser->loginAs($user)
                    ->visit('/ulasansaya/35')
                    ->pause(2000)
                    ->assertPathIs('/ulasansaya/35')
                    ->assertSee('Detail Ulasan Saya') // Assertion 1: Judul halaman
                    ->assertSee('Rating:')             // Assertion 2: Label rating ada
                    ->assertSee('Kembali ke Rating Saya') // Assertion 3: Tombol kembali ada
                    ->screenshot('ulasansaya-35');

            } catch (\Exception $e) {
                $html = $browser->driver->getPageSource();
                file_put_contents(storage_path('app/dusk-errors/ulasansaya-error.html'), $html);
                $browser->screenshot('ulasansaya-error');
                throw $e;
            }
        });
    }
}
