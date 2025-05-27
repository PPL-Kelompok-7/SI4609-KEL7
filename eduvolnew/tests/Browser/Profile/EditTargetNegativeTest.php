<?php

namespace Tests\Browser\Profile;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditTargetNegativeTest extends DuskTestCase
{
    public function testEditTargetNegative()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(2)
                ->visit('/profile')
                ->click('@milestone-tab')
                ->pause(500)
                ->click('@edit-target-btn')
                ->assertPathIs('/profile/edit-target')
                ->type('@target-hours-input', '5001')
                ->pause(500);

            $browser->assertScript("return document.querySelector('[dusk=\"target-hours-input\"]').validationMessage;", 'Value must be less than or equal to 5000.');
        });
    }
}
