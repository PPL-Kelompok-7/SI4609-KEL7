<?php

namespace Tests\Browser\Profile;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProfileReadPositiveTest extends DuskTestCase
{
    public function testProfilePositive()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(8)
                ->visit('/profile')
                ->click('@milestone-tab')
                ->pause(1000)
                ->scrollIntoView('@total-hours')
                ->pause(500)
                ->assertSeeIn('@total-hours', '212')
                ->assertSeeIn('@total-sessions', '8')
                ->assertSee('Target Hours')
                ->assertSee('Badges')
                ->assertSee('BRONZE (1-500)')
                ->screenshot('milestone-tab');
        });
    }
}
