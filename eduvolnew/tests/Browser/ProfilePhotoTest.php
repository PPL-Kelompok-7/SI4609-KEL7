<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfilePhotoTest extends DuskTestCase
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

    public function test_upload_profile_photo_success()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                   ->visit('/profile/edit')
                   ->attach('profile_photo', __DIR__.'/photos/small-photo.jpg') // pastikan file ada
                   ->press('Simpan')
                   ->assertSee('Profil berhasil diperbarui')
                   ->visit('/profile')
                   ->assertPresent('img[src*="profile-photos"]'); // cek apakah foto muncul
        });
    }

    public function test_upload_profile_photo_failed()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                   ->visit('/profile/edit')
                   ->attach('profile_photo', __DIR__.'/photos/large-photo.jpg') // file > 2MB
                   ->press('Simpan')
                   ->assertSee('Ukuran maksimal file 2 mb');
        });
    }
}
