# EduVolunteer - Panduan Pengembangan Tim

## Pendahuluan
Halo! Selamat datang di proyek EduVolunteer. Panduan ini dibuat untuk membantu Anda memahami dan menggunakan database serta fitur-fitur yang sudah tersedia. Sebagai tim yang baru belajar menggunakan GitHub, panduan ini akan menjelaskan langkah-langkah dengan detail dan mudah dipahami.

## Struktur Proyek
Proyek ini menggunakan beberapa branch untuk memisahkan tanggung jawab:

1. **`database_structure`**
   - Berisi semua struktur database
   - Migration files
   - Model files
   - Seeder files
   - Dokumentasi database

2. **`main`**
   - Branch utama
   - Berisi fitur auth (login/register)
   - Layout dasar
   - Fitur umum

3. **`Danit_Branch`**
   - Branch untuk fitur profile
   - Berisi controller dan view profile

4. **Branch Tim Lain**
   - Setiap tim memiliki branch sendiri
   - Contoh: `feature_agenda`, `feature_partner`, dll

## Cara Menggunakan Database

### 1. Persiapan Awal
```bash
# 1. Pastikan Anda di branch Anda sendiri
git checkout nama_branch_anda

# 2. Pull database structure
git pull origin database_structure

# 3. Pull fitur auth dari main
git pull origin main
```

### 2. Setup Database
1. **Copy file `.env.example` menjadi `.env`**
2. **Sesuaikan konfigurasi database di `.env`:**
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eduvolnew
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Jalankan migration dan seeder:**
   ```bash
   php artisan migrate:fresh --seed
   ```

## Struktur Database

### 1. Tabel Autentikasi & User
1. **Tabel `users`**
   - Menyimpan data pengguna (admin, volunteer, partner)
   - Kolom penting: `id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `phone_number`, `address`, `profile_photo`
   - Relasi: `role_id` terhubung ke tabel `roles`

2. **Tabel `roles`**
   - Menyimpan data role/peran pengguna
   - Kolom: `id`, `name`, `description`
   - Role yang tersedia: admin, volunteer, partner

3. **Tabel `password_reset_tokens`**
   - Untuk fitur reset password
   - Kolom: `email`, `token`, `created_at`

### 2. Tabel Agenda & Event
1. **Tabel `agendas`**
   - Menyimpan data agenda/event
   - Kolom: `id`, `title`, `description`, `date`, `location`, `status`, `created_at`, `updated_at`
   - Relasi: Terhubung ke tabel `users` (pembuat agenda)

2. **Tabel `agenda_participants`**
   - Menyimpan data peserta agenda
   - Kolom: `id`, `agenda_id`, `user_id`, `status`, `created_at`, `updated_at`
   - Relasi: Terhubung ke tabel `agendas` dan `users`

### 3. Tabel Partner & Volunteer
1. **Tabel `partners`**
   - Menyimpan data partner/organisasi
   - Kolom: `id`, `name`, `description`, `logo`, `website`, `created_at`, `updated_at`
   - Relasi: Terhubung ke tabel `users` (admin partner)

2. **Tabel `volunteers`**
   - Menyimpan data tambahan volunteer
   - Kolom: `id`, `user_id`, `skills`, `experience`, `created_at`, `updated_at`
   - Relasi: Terhubung ke tabel `users`

### 4. Tabel Sistem
1. **Tabel `failed_jobs`**
   - Untuk logging job yang gagal
   - Kolom: `id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`

2. **Tabel `personal_access_tokens`**
   - Untuk API authentication
   - Kolom: `id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`

## Relasi Antar Tabel
1. **User & Role**
   - Satu user memiliki satu role
   - Satu role bisa dimiliki banyak user

2. **Agenda & User**
   - Satu agenda dibuat oleh satu user
   - Satu user bisa membuat banyak agenda

3. **Agenda & Participant**
   - Satu agenda bisa diikuti banyak participant
   - Satu user bisa mengikuti banyak agenda

4. **Partner & User**
   - Satu partner memiliki satu admin user
   - Satu user bisa menjadi admin untuk satu partner

5. **Volunteer & User**
   - Satu volunteer terhubung ke satu user
   - Satu user bisa menjadi satu volunteer

## Data Dummy yang Tersedia
Seeder menyediakan data dummy untuk testing:

### Admin
- Email: admin@eduvolunteer.com
- Password: admin123

### Volunteer
1. User 1:
   - Email: john.doe@example.com
   - Password: password123

2. User 2:
   - Email: jane.smith@example.com
   - Password: password123

### Partner
- Email: partner@example.com
- Password: password123

## Cara Menggunakan Data di Halaman Anda

### 1. Contoh Query Dasar
```php
// Di Controller Anda
use App\Models\User;
use App\Models\Role;
use App\Models\Agenda;
use App\Models\Partner;
use App\Models\Volunteer;

// Mengambil semua user
$users = User::all();

// Mengambil user berdasarkan role
$volunteers = User::where('role_id', 2)->get();

// Mengambil user dengan relasi role
$user = User::with('role')->find(1);

// Mengambil agenda
$agendas = Agenda::with('creator')->get();

// Mengambil partner
$partners = Partner::with('admin')->get();

// Mengambil volunteer
$volunteers = Volunteer::with('user')->get();
```

### 2. Contoh di View
```php
// Di view Anda
@foreach($users as $user)
    <div>
        <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
        <p>Role: {{ $user->role->name }}</p>
    </div>
@endforeach

@foreach($agendas as $agenda)
    <div>
        <h3>{{ $agenda->title }}</h3>
        <p>Created by: {{ $agenda->creator->first_name }}</p>
    </div>
@endforeach
```

## Jika Tabel Kosong
Jika tabel yang Anda butuhkan kosong:

### 1. Gunakan Seeder
- Buat file seeder baru di `database/seeders/`
- Contoh: `AgendaSeeder.php`
```php
public function run()
{
    Agenda::create([
        'title' => 'Test Agenda',
        'description' => 'Test Description',
        'date' => now(),
        'location' => 'Test Location',
        'status' => 'active',
        'user_id' => 1
    ]);
}
```

### 2. Jalankan Seeder
```bash
php artisan db:seed --class=AgendaSeeder
```

## Troubleshooting

### Error Umum dan Solusinya

1. **Error: Table not found**
   ```bash
   # Solusi: Jalankan migration
   php artisan migrate
   ```

2. **Error: Class not found**
   ```bash
   # Solusi: Clear cache
   php artisan config:clear
   php artisan cache:clear
   ```

3. **Error: Data tidak muncul**
   - Cek query di controller
   - Cek relasi antar tabel
   - Cek data di database (phpMyAdmin)

4. **Error: Git conflict**
   - JANGAN langsung merge
   - Backup dulu branch Anda
   - Diskusikan dengan database developer

## Do's and Don'ts

### Yang Harus Dilakukan (Do's)
1. ✅ Selalu pull dari `database_structure` sebelum mulai kerja
2. ✅ Backup database lokal Anda
3. ✅ Test fitur setelah pull
4. ✅ Gunakan data dummy untuk testing
5. ✅ Konsultasi jika ada error

### Yang Tidak Boleh Dilakukan (Don'ts)
1. ❌ JANGAN ubah struktur tabel
2. ❌ JANGAN hapus data dummy
3. ❌ JANGAN push ke `database_structure`
4. ❌ JANGAN merge tanpa persetujuan
5. ❌ JANGAN abaikan error

## Best Practices

### 1. Sebelum Mulai
- Pull terbaru dari `database_structure`
- Backup database lokal
- Test login/register

### 2. Saat Development
- Gunakan data dummy
- Test fitur secara berkala
- Dokumentasikan perubahan

### 3. Jika Ada Error
- Screenshot error
- Cek log di `storage/logs`
- Konsultasi ke Group

## Kontak
Jika ada pertanyaan atau masalah:
- Group Chat: [Link Group Chat]

## Catatan Penting
1. Database ini sudah include fitur login/register
2. Jangan mengubah struktur tabel
3. Selalu test fitur setelah pull
4. Backup database secara berkala
5. Gunakan data dummy untuk testing 

## Setup Routes di web.php

Setiap tim perlu menambahkan route berikut sesuai dengan fitur yang digunakan:

### 1. Route Authentication
```php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
```

### 2. Route Profile
```php
use App\Http\Controllers\ProfileController;

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
```

### 3. Route Partner
```php
use App\Http\Controllers\PartnerController;

// Partner Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::get('/partners/create', [PartnerController::class, 'create'])->name('partners.create');
    Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
    Route::get('/partners/{partner}', [PartnerController::class, 'show'])->name('partners.show');
    Route::get('/partners/{partner}/edit', [PartnerController::class, 'edit'])->name('partners.edit');
    Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
    Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');
});
```

### 4. Route Event/Agenda
```php
use App\Http\Controllers\EventController;

// Event Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    
    // Event Registration
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
    Route::post('/events/{event}/unregister', [EventController::class, 'unregister'])->name('events.unregister');
});
```

### 5. Route Rating
```php
use App\Http\Controllers\RatingController;

// Rating Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/events/{event}/rate', [RatingController::class, 'store'])->name('ratings.store');
    Route::put('/ratings/{rating}', [RatingController::class, 'update'])->name('ratings.update');
    Route::delete('/ratings/{rating}', [RatingController::class, 'destroy'])->name('ratings.destroy');
});
```

### Cara Menggunakan Route

1. **Buka file `routes/web.php`**
2. **Tambahkan use statement** untuk controller yang diperlukan di bagian atas file
3. **Copy route yang dibutuhkan** sesuai fitur yang sedang dikembangkan
4. **Pastikan nama controller sesuai** dengan struktur folder Anda
5. **Sesuaikan middleware** jika diperlukan (misalnya menambahkan middleware role)

### Catatan Penting
- Pastikan semua controller yang direferensikan sudah dibuat
- Perhatikan penempatan route (urutannya bisa mempengaruhi cara kerja aplikasi)
- Gunakan route name untuk generating URL di view (`route('nama.route')`)
- Selalu test route setelah menambahkannya dengan:
  ```bash
  php artisan route:list
  ``` 