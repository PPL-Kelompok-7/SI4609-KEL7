<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class VoucherPenggunaTest extends DuskTestCase
{
    public function testVoucherPenggunaPageAndGenerateCode()
    {
        $this->browse(function (Browser $browser) {
            try {
                // Pastikan user dengan ID ini ada di database
                $user = User::find(1); // Ganti jika perlu
                
                $browser->loginAs($user)
                        ->visit('/voucherpengguna')
                        ->pause(2000)
                        ->assertPathIs('/voucherpengguna')
                        ->screenshot('voucherpengguna-page');

                // Jika ada tombol Generate Code, klik tombol pertama
                if ($browser->element('form button.generate-btn')) {
                    $browser->press('Generate Code')
                            ->pause(1000)
                            ->screenshot('voucherpengguna-after-generate');
                }

            } catch (\Exception $e) {
                $html = $browser->driver->getPageSource();
                file_put_contents(storage_path('app/dusk-errors/voucherpengguna-error.html'), $html);
                $browser->screenshot('voucherpengguna-error');
                throw $e;
            }
        });
    }
}
