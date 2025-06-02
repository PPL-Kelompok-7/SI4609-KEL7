<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class PaymentTest extends DuskTestCase
{
    public function testLangsungKeHalamanPayment()
    {
        $this->browse(function (Browser $browser) {
            try {
                // Login sebagai user dengan ID 1 (ganti sesuai user valid yang terdaftar di event 3)
                $user = User::find(1);
                
                $browser->loginAs($user)
                    ->visit('/payments/3')  // URL yang ingin dites
                    ->pause(2000)           // beri waktu load halaman
                    ->assertPathIs('/payments/3')
                    ->screenshot('payment-halaman');

            } catch (\Exception $e) {
                // Simpan halaman error & screenshot jika gagal
                $html = $browser->driver->getPageSource();
                file_put_contents(storage_path('app/dusk-errors/payment-error.html'), $html);
                $browser->screenshot('payment-error');
                throw $e;
            }
        });
    }
}