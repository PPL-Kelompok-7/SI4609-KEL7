<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PaymentTest extends DuskTestCase
{
    // Test Case #7: Mengambil data event di halaman pembayaran
    public function testEventAppearsInPaymentPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1)) // Pastikan user login
                    ->visit('/events')
                    ->click('@register-event-button') // Asumsikan ada tombol register
                    ->visit('/payment') // Akses halaman pembayaran
                    ->assertSee('Detail Tiket') // Verifikasi data muncul
                    ->assertSee('Nama Event'); // Nama event yang dipilih
        });
    }

    // Test Case #8: Mengunggah bukti pembayaran secara manual
    public function testUploadPaymentProof()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1)) // Asumsi user sudah login
                    ->visit('/payment/upload')
                    ->attach('payment_proof', __DIR__.'/files/dummy-proof.jpg') // File dummy untuk testing
                    ->press('Upload')
                    ->waitForText('Bukti berhasil diunggah') // Notifikasi berhasil
                    ->assertSee('Bukti berhasil diunggah');
        });
    }
}
