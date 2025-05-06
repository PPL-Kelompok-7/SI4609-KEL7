<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class ProfileTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    }

    public function test_edit_profile_success()
    {
        $user = User::where('email', 'john.doe@example.com')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                   ->visit('/profile/edit')
                   ->type('first_name', 'NamaBaru')
                   ->type('last_name', 'Aja')
                   ->type('profession', 'Developer')
                   ->type('domicile', 'Bandung')
                   ->press('Simpan')
                   ->assertSee('Profil berhasil diperbarui')
                   ->visit('/profile')
                   ->assertSee('NamaBaru Aja')
                   ->assertSee('Developer')
                   ->assertSee('Bandung');
        });
    }

    public function test_edit_profile_failed()
    {
        $user = User::where('email', 'john.doe@example.com')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                   ->visit('/profile/edit')
                   ->type('first_name', '') // kosongkan required field
                   ->press('Simpan')
                   ->assertSee('The first name field is required');
        });
    }
}
