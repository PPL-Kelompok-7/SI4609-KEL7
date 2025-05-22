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
use App\Http\Controllers\VoucherUserController;
use App\Http\Controllers\PaymentController;
use App\Models\Event;
use App\Models\Payment;
use App\Http\Controllers\DaftarRelawanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\AdminAuthController;

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

// Tambahan: route login admin (frontend)
Route::get('/loginadmin', function () {
    return view('loginadmin');
})->name('loginadmin');

// Partner Routes
Route::get('/loginmitra', function () {
    return view('loginmitra');
})->name('loginmitra');

Route::get('/registermitra', function () {
    return view('registermitra');
})->name('registermitra');

// Admin Authentication Routes (backend)
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

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
        Route::get('/edit-target', [ProfileController::class, 'editTarget'])->name('profile.editTarget');
        Route::post('/update-target', [ProfileController::class, 'updateTarget'])->name('profile.updateTarget');
    });

    // VerifBayar Route
    Route::get('/verifbayar', function () {
        $verifications = []; // array kosong, supaya tidak error
        return view('verifbayar', compact('verifications'));
    })->name('verifbayar');

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
        $payment = Payment::where('user_id', auth()->id())->first();
        return view('pembayaran', compact('payment'));
    })->name('pembayaran');

    Route::get('pembayaran/berhasil', function () {
        return view('pembayaran2');
    })->name('pembayaran.berhasil');

    // History Pembayaran
    Route::get('history-pembayaran', function () {
        return view('historypembayaran');
    })->name('history.pembayaran');
    Route::get('/history-pembayaran', [PaymentController::class, 'history'])->name('history-pembayaran');

    // Voucher Routes
    Route::get('/vouchers/create', [VoucherController::class, 'create'])->name('vouchers.create');
    Route::post('/vouchers', [VoucherController::class, 'store'])->name('vouchers.store');
    Route::get('/voucherpengguna', [VoucherUserController::class, 'index'])->name('voucherpengguna.index');
    Route::get('/voucher/{id}/use', [VoucherController::class, 'useVoucher'])->name('voucher.use');
    Route::get('/voucherall', [VoucherUserController::class, 'voucherAll'])->name('voucherall.index');
    Route::get('voucher', [VoucherController::class, 'index'])->name('voucherpengguna');

    // Payment Controller Routes
    Route::get('/payments/{event}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{event}/upload-proof', [PaymentController::class, 'uploadProof'])->name('payments.uploadProof');

    // Daftar Relawan
    Route::get('/daftarrelawan/{id}', [DaftarRelawanController::class, 'index'])->name('daftarrelawan');
    Route::post('/regist-event/store', [DaftarRelawanController::class, 'store'])->name('regist-event.store');

    // Notifikasi untuk mitra (event owner)
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
});

// Event routes (public)
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/event-detail/{id}', [EventController::class, 'show'])->name('event.detail');

// Posting Event
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

// Home, Agenda, Partners, Volunteers
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

// Tampilkan form event
Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
// Proses submit form event
Route::post('/event/store', [EventController::class, 'store'])->name('event.store');

// Tambahan: POST history-kegiatan/store (untuk outside group)
Route::post('/history-kegiatan/store', [HistoryKegiatanController::class, 'store'])->name('history-kegiatan.store');

Route::get('/wishlist', function () {
    return view('wishlist');
})->name('wishlist');

Route::post('/profile/milestone/update-target', [ProfileController::class, 'updateTarget'])->name('profile.milestone.updateTarget');

Route::get('/ratingrelawan', function () {
    return view('ratingrelawan');
})->name('ratingrelawan');
