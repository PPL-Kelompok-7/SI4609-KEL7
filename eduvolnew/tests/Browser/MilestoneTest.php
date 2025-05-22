<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class MilestoneTest extends DuskTestCase
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

    public function test_view_milestone()
    {
        // Gunakan user yang sudah ada di database testing
        $user = User::where('email', 'john.doe@example.com')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                   ->visit('/profile')
                   ->click('#milestone-tab') // sesuaikan dengan ID/selector tab milestone
                   ->assertSee('Badge Saat Ini')
                   ->assertSee('Progress ke Platinum')
                   ->assertSee('Bronze')
                   ->assertSee('Silver')
                   ->assertSee('Gold')
                   ->assertSee('Platinum');
        });
    }
}
