<?php

namespace Tests\Browser\Milestone;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MilestonePositiveTest extends DuskTestCase
{
    /**
     * Test user with real milestone data can see milestone section correctly.
     */
    public function test_user_can_view_existing_milestone_data()
    {
        // Ambil user dari database produksi (yang sudah diimport ke testing)
        $user = \App\Models\User::where('name', 'test 4')->firstOrFail();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/profile')
                    ->click('@milestone-preview') // Pastikan ada selector ini di Blade
                    ->assertSee('Milestone')
                    ->assertSee('Target Hours')
                    ->assertSee('Total Sessions')
                    ->assertSee('Total Hours')
                    ->assertSee('Badges')
                    ->assertSee('BRONZE') // Dari badge aktif yang terlihat pada screenshot
                    ->assertPresent('.badge-bronze.active')
                    ->assertPresent('.progress-bar');

            // Verifikasi persentase progress bar jika ingin dinamis:
            $milestone = $user->milestone;
            if ($milestone) {
                $expectedWidth = round(($milestone->total_hours / $milestone->target_hours) * 100);
                $browser->assertAttributeContains('.progress-bar', 'style', "width: {$expectedWidth}%");
            }
        });
    }
}
