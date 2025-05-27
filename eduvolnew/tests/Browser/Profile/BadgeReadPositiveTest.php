<?php

namespace Tests\Browser\Profile;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BadgeReadPositiveTest extends DuskTestCase
{
    public function testBadgeReadPositive()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(8)
                ->visit('/profile')
                ->click('@milestone-tab')
                ->pause(1000)
                // Cek badge bronze aktif (style attribute tidak mengandung 'grayscale')
                ->assertScript("return document.querySelector('[dusk=\"badge-bronze\"]').getAttribute('style').includes('grayscale');", false);
        });
    }
}
