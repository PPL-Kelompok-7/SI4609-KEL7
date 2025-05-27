<?php

namespace Tests\Browser\Profile;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProfileReadNegativeTest extends DuskTestCase
{
    public function testProfileNegative()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(2)
                ->visit('/profile')
                ->click('@milestone-tab')
                ->pause(1000)
                ->scrollIntoView('@total-hours')
                ->pause(500)
                ->screenshot('milestone-tab-negative');

            $text = $browser->script([
                "return document.querySelector('[dusk=\"total-hours\"]').innerText;"
            ]);
            dump($text[0]);

            $style = $browser->attribute('@badge-bronze', 'style');
            $this->assertStringContainsString('grayscale', $style);
        });
    }
}
