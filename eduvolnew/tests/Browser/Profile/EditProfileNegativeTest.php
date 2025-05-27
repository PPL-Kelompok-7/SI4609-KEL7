<?php

namespace Tests\Browser\Profile;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditProfileNegativeTest extends DuskTestCase
{
    public function testEditProfileNegative()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(2)
                ->visit('/profile')
                ->click('@edit-profile-btn')
                ->type('@first_name', '') // kosongkan required
                ->scrollIntoView('@save-profile-btn')
                ->pause(500)
                ->click('@save-profile-btn')
                // Cek validasi HTML5
                ->script([
                    "return document.querySelector('[dusk=\"first_name\"]').validationMessage;"
                ]);
        });
    }
}
