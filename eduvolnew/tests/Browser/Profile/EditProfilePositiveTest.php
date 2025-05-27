<?php

namespace Tests\Browser\Profile;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditProfilePositiveTest extends DuskTestCase
{
    public function testEditProfilePositive()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(4)
                ->visit('/profile')
                ->click('@edit-profile-btn')
                ->type('@first_name', 'NamaBaru')
                ->type('@last_name', 'BelakangBaru')
                ->type('@profession', 'ProfesiBaru')
                ->type('@domicile', 'DomisiliBaru')
                ->type('@mobile_phone', '08123456789')
                ->scrollIntoView('@save-profile-btn')
                ->pause(500)
                ->press('@save-profile-btn')
                ->assertSee('NamaBaru')
                ->assertSee('BelakangBaru')
                ->assertSee('ProfesiBaru')
                ->assertSee('DomisiliBaru');
        });
    }
}
