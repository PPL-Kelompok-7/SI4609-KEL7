<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('register', function () {
    return view('register');
})->name('register');


Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('/events', function () {
    // Data dummy contoh, nanti bisa diambil dari database juga
    $events = [
        [
            'image' => 'images/ngajar-ngoding.jpg',
            'title' => 'Ngajar Ngoding Selasa #6',
            'price' => '250k',
            'date'  => '22 Oktober 2025',
        ],
        [
            'image' => 'images/bela-negara.png',
            'title' => 'Bela Negara Sejak Dini',
            'price' => '200k',
            'date'  => '7 Mei 2025',
        ],
        [
            'image' => 'images/ngoding101.png',
            'title' => 'Belajar Ngoding 101',
            'price' => 'Free',
            'date'  => '22 Oktober 2024',
        ],
        [
            'image' => 'images/ngoding101.png',
            'title' => 'Belajar Ngoding 101',
            'price' => 'Free',
            'date'  => '22 Oktober 2024',
        ],
        [
            'image' => 'images/ngoding101.png',
            'title' => 'Belajar Ngoding 101',
            'price' => 'Free',
            'date'  => '22 Oktober 2024',
        ],
        [
            'image' => 'images/ngoding101.png',
            'title' => 'Belajar Ngoding 101',
            'price' => 'Free',
            'date'  => '22 Oktober 2024',
        ],
        // Tambah lagi sesuai kebutuhan...
    ];

    return view('event', compact('events'));
});

Route::get('/event-detail', function () {
    return view('event-detail');
});

Route::get('/posting-event', function () {
    return view('posting-event');
});

Route::get('/formposting-event', function () {
    return view('formposting-event');
});

Route::get('/event-registered', function () {
    return view('event-registered');
});

Route::get('pembayaran', function () {
    return view('pembayaran');
})->name('pembayaran');

// Route untuk halaman pembayaran berhasil
Route::get('pembayaran/berhasil', function () {
    return view('pembayaran2');
})->name('pembayaran.berhasil');

// Route untuk halaman history pembayaran
Route::get('history-pembayaran', function () {
    return view('historypembayaran');
})->name('history.pembayaran');

Route::get('voucher', function () {
    return view('voucherpengguna');
})->name('voucherpengguna');

Route::get('daftarrelawan', function () {
    return view('daftarrelawan');
})->name('daftarrelawan');

Route::get('historykegiatan', function () {
    return view('historykegiatan');
})->name('historykegiatan');
