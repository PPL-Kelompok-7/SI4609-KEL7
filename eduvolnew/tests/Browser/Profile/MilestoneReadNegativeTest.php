<?php

namespace Tests\Browser\Profile;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MilestoneReadNegativeTest extends DuskTestCase
{
    public function testMilestoneReadNegative()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(2)
                ->visit('/profile')
                ->click('@milestone-tab')
                ->assertSeeIn('@total-sessions', '0')
                ->assertSeeIn('@total-hours', '0')
                ->assertSee('Partisipasi')
                ->assertSee('Milestone');
        });
    }
}
