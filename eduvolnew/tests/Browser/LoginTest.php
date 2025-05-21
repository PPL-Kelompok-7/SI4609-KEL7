<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test Case: TC.Login.001
     * Test: Menguji login dengan kredensial valid (Positif)
     */
    public function test_user_can_login_with_valid_credentials()
    {
        // Gunakan user pertama yang ada di database
        $user = User::first();
        if (!$user) {
            $this->markTestSkipped('Tidak ada user di database');
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                   ->type('email', $user->email)
                   ->type('password', 'password') // Password default dari factory
                   ->press('Login')
                   ->assertPathIs('/')
                   ->assertSee('Selamat datang!');
        });
    }

    /**
     * Test Case: TC.Login.002
     * Test: Menguji login dengan email tidak terdaftar (Negatif)
     */
    public function test_user_cannot_login_with_unregistered_email()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                   ->type('email', 'unregistered@example.com')
                   ->type('password', 'password123')
                   ->press('Login')
                   ->assertPathIs('/login')
                   ->assertSee('Email belum terdaftar');
        });
    }

    /**
     * Test Case: TC.Login.003
     * Test: Menguji login dengan password salah (Negatif)
     */
    public function test_user_cannot_login_with_wrong_password()
    {
        // Gunakan user pertama yang ada di database
        $user = User::first();
        if (!$user) {
            $this->markTestSkipped('Tidak ada user di database');
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                   ->type('email', $user->email)
                   ->type('password', 'wrongpassword')
                   ->press('Login')
                   ->assertPathIs('/login')
                   ->assertSee('Email atau password salah');
        });
    }
} 