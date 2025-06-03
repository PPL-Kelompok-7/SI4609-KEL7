<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RatingSayaNegativeTest extends DuskTestCase
{
    /**
     * Test untuk user yang belum punya rating.
     */
    public function testUserTanpaRatingMenampilkanPesan()
    {
        $this->browse(function (Browser $browser) {
            try {
                // Ambil user dengan id 1 (pastikan user ini tidak punya review)
                $user = User::find(1);

                // Pastikan user ditemukan
                $this->assertNotNull($user, "User dengan ID 1 tidak ditemukan.");

                // Kunjungi halaman /ratingsaya sebagai user
                $browser->loginAs($user)
                        ->visit('/ratingsaya')
                        ->pause(2000)
                        ->assertPathIs('/ratingsaya')
                        ->screenshot('ratingsaya-negatif-berhasil');

            } catch (\Exception $e) {
                // Jika gagal, simpan isi halaman untuk dianalisis
                $html = $browser->driver->getPageSource();
                file_put_contents(storage_path('app/dusk-errors/ratingsaya-negative-error.html'), $html);
                $browser->screenshot('ratingsaya-negative-error');
                throw $e;
            }
        });
    }
}
