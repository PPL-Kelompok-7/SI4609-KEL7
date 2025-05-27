<?php

namespace Tests\Browser\Profile;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UploadPhotoNegativeTest extends DuskTestCase
{
    public function testUploadPhotoNegative()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(8)
                ->visit('/profile')
                ->click('@edit-profile-btn')
                ->type('@first_name', 'NamaBaru')
                ->type('@last_name', 'BelakangBaru')
                ->type('@profession', 'ProfesiBaru')
                ->type('@domicile', 'DomisiliBaru')
                ->attach('@profile_photo', __DIR__.'/../photos/large-photo.png')
                ->acceptDialog('Ukuran file maksimal 2MB')
                ->screenshot('profile-after-upload-negative');
        });
    }
}
