<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\HistoryKegiatanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\PaymentController;
use App\Models\Event;
use App\Http\Controllers\DaftarRelawanController;

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

// Public Routes
Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Authentication Routes
Route::middleware('web')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Protected Routes (require authentication)
Route::middleware(['web', 'auth'])->group(function () {
    // Profile Management Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::prefix('profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
        Route::put('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update-avatar');
        Route::get('/history', [ProfileController::class, 'history'])->name('profile.history');
        Route::get('/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    });

    // Event Routes
    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('events.index');
        Route::get('/{id}', [EventController::class, 'show'])->name('events.show');
        Route::get('/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/', [EventController::class, 'store'])->name('events.store');
        Route::get('/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/{id}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/{id}', [EventController::class, 'destroy'])->name('events.destroy');
        Route::post('/{id}/register', [EventController::class, 'register'])->name('events.register');
        Route::get('/registered', [EventController::class, 'registered'])->name('events.registered');
    });

    // Relawan Routes
    Route::prefix('relawan')->group(function () {
        Route::get('/', [RelawanController::class, 'index'])->name('relawan.index');
        Route::get('/create', [RelawanController::class, 'create'])->name('relawan.create');
        Route::post('/', [RelawanController::class, 'store'])->name('relawan.store');
        Route::get('/{id}', [RelawanController::class, 'show'])->name('relawan.show');
        Route::get('/{id}/edit', [RelawanController::class, 'edit'])->name('relawan.edit');
        Route::put('/{id}', [RelawanController::class, 'update'])->name('relawan.update');
    });

    // History Kegiatan Routes
    Route::prefix('history-kegiatan')->group(function () {
        Route::get('/', [HistoryKegiatanController::class, 'index'])->name('history-kegiatan.index');
        Route::get('/{id}', [HistoryKegiatanController::class, 'show'])->name('history-kegiatan.show');
        Route::post('/store', [HistoryKegiatanController::class, 'store'])->name('history-kegiatan.store');
    });

    // Payment Routes
    Route::get('pembayaran', function () {
        return view('pembayaran');
    })->name('pembayaran');

    Route::get('pembayaran/berhasil', function () {
        return view('pembayaran2');
    })->name('pembayaran.berhasil');

    Route::get('/history-pembayaran', [PaymentController::class, 'history'])->name('history-pembayaran');

    // Voucher Routes
    Route::get('voucher', function () {
        return view('voucherpengguna');
    })->name('voucherpengguna');

    Route::get('/vouchers', [VoucherController::class, 'index'])->name('vouchers.index');

    Route::get('/payments/{registrationId}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{paymentId}/upload-proof', [PaymentController::class, 'uploadProof'])->name('payments.uploadProof');

    Route::get('/daftarrelawan/{id}', [DaftarRelawanController::class, 'index'])->name('daftarrelawan');

    Route::post('/regist-event/store', [DaftarRelawanController::class, 'store'])->name('regist-event.store');
});

Route::get('/events', [EventController::class, 'index'])->name('events.index');

Route::get('/event-detail/{id}', [EventController::class, 'show'])->name('event.detail');

Route::get('/posting-event', function () {
    $events = Event::all();
    return view('posting-event', compact('events'));
});

Route::get('/formposting-event', function () {
    return view('formposting-event');
});

Route::get('/event-registered', function () {
    return view('event-registered');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/agenda', function () {
    return view('agenda');
})->name('agenda');

Route::get('/partners', function () {
    return view('partners');
})->name('partners');

Route::get('/volunteers', function () {
    return view('volunteers');
})->name('volunteers');

// Tampilkan form
Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
// Proses submit form
Route::post('/event/store', [EventController::class, 'store'])->name('event.store');

Route::post('/history-kegiatan/store', [HistoryKegiatanController::class, 'store'])->name('history-kegiatan.store');