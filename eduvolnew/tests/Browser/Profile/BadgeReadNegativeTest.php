<?php

namespace Tests\Browser\Profile;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BadgeReadNegativeTest extends DuskTestCase
{
    public function testBadgeReadNegative()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(2)
                ->visit('/profile')
                ->click('@milestone-tab')
                ->pause(1000);

            // Cek badge bronze tidak aktif (style attribute mengandung 'grayscale')
            $browser->assertScript("return document.querySelector('[dusk=\"badge-bronze\"]').getAttribute('style').includes('grayscale');", true);
        });
    }
}
