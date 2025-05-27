<?php

namespace Tests\Browser\Profile;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UploadPhotoPositiveTest extends DuskTestCase
{
    public function testUploadPhotoPositive()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(8)
                ->visit('/profile')
                ->click('@edit-profile-btn')
                ->type('@first_name', 'NamaBaru')
                ->type('@last_name', 'BelakangBaru')
                ->type('@profession', 'ProfesiBaru')
                ->type('@domicile', 'DomisiliBaru')
                ->attach('@profile_photo', __DIR__.'/../photos/small-photo.png')
                ->pause(1000)
                ->scrollIntoView('@save-profile-btn')
                ->pause(500)
                ->click('@save-profile-btn')
                ->pause(1000)
                ->assertPathIs('/profile')
                ->assertSee('Relawan')
                ->assertSee('NamaBaru BelakangBaru')
                ->screenshot('profile-after-upload');
        });
    }
}
