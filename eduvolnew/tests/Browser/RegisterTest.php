<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * Test case: Mengisi form register dengan data valid
     * Ekspektasi: Berhasil redirect ke halaman login
     */
    public function test_register_with_valid_data()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'Test User')
                ->type('email', 'testuser@example.com')
                ->type('password', 'password123')
                ->type('password_confirmation', 'password123')
                ->press('Register')
                ->assertPathIs('/login')
                ->assertSee('Login'); // Pastikan halaman login ada tulisan "Login"
        });
    }

    /**
     * Test case: Email tidak valid (tanpa "@")
     * Ekspektasi: Menampilkan error email tidak valid
     */
    public function test_register_with_invalid_email()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'Test User')
                ->type('email', 'invalid-email') // tanpa "@"
                ->type('password', 'password123')
                ->type('password_confirmation', 'password123')
                ->press('Register')
                ->assertSee('email tidak sesuai'); // Sesuaikan ini dengan pesan error dari sistem Anda
        });
    }

    /**
     * Test case: Password kosong
     * Ekspektasi: Muncul pesan bahwa password harus diisi
     */
    public function test_register_with_empty_password()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'Test User')
                ->type('email', 'user@example.com')
                ->type('password', '')
                ->type('password_confirmation', '')
                ->press('Register')
                ->assertSee('password harus diisi'); // Sesuaikan ini dengan validasi yang muncul
        });
    }
}
