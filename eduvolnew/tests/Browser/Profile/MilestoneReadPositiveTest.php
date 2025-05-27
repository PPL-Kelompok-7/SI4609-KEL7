<?php

namespace Tests\Browser\Profile;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MilestoneReadPositiveTest extends DuskTestCase
{
    public function testMilestoneReadPositive()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(8)
                ->visit('/profile')
                ->pause(500)
                ->click('@milestone-tab')
                ->waitFor('@total-sessions', 10)
                ->pause(1000)
                ->assertSeeIn('@total-sessions', '8')
                ->assertSeeIn('@total-hours', '212')
                ->assertSee('Partisipasi')
                ->assertSee('Milestone');
        });
    }
}
