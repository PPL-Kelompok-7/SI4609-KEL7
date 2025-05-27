<?php

namespace Tests\Browser\Profile;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditTargetPositiveTest extends DuskTestCase
{
    public function testEditTargetPositive()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(8)
                ->visit('/profile')
                ->click('@milestone-tab')
                ->waitFor('@edit-target-btn', 5)
                ->scrollIntoView('@edit-target-btn')
                ->pause(500)
                ->click('@edit-target-btn')
                ->assertPathIs('/profile/edit-target')
                ->type('@target-hours-input', '1000')
                ->press('@save-target-btn')
                ->visit('/profile')
                ->click('@milestone-tab')
                ->assertSee('212 hours of 1000 (21%)');
        });
    }
}
