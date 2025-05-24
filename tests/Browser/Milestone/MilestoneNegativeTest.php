<?php

namespace Tests\Browser\Milestone;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class MilestoneNegativeTest extends DuskTestCase
{
    public function test_user_sees_empty_milestone()
    {

        $user = User::where('email', 'test2@example.com')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/profile')
                ->waitFor('@milestone-preview', 5)
                ->click('@milestone-preview')
                ->waitForText('Milestone Saya', 5)
                
                
                ->assertSee('Target Hours: 50')
                ->assertSee('0 hours of 50 (0%)')
                ->assertSee('Total Sessions : 0')
                ->assertSee('Total Hours : 0')

                
                ->assertPresent('.badge-bronze.inactive')
                ->assertPresent('.badge-silver.inactive')
                ->assertPresent('.badge-gold.inactive')

                
                ->assertPresent('.progress-bar')
                ->assertAttributeContains('.progress-bar', 'style', 'width: 0%')

                ->assertSee('Belum ada event yang diikuti, Mulai berkontribusi sekarang!');
        });
    }
}
