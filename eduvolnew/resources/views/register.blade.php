<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('EDUVOL LOGO 1.png') }}" alt="Edu Volunteer">
        </div>
        <div class="form-container">
            <h2>Selamat Datang!</h2>
            <p>Silahkan isi data untuk registrasi</p>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="input-group">
                    <input type="text" name="first_name" placeholder="Nama Depan" value="{{ old('first_name') }}" required>
                    <input type="text" name="last_name" placeholder="Nama Belakang" value="{{ old('last_name') }}" required>
                </div>
                <div class="input-group">
                <input type="date" name="birth_date" id="birth_date" class="date-input" placeholder="Tanggal Lahir" value="{{ old('birth_date') }}" required>
                    <input type="text" name="profession" placeholder="Profesi" value="{{ old('profession') }}" required>
                </div>
                <input type="text" name="domicile" placeholder="Domisili" value="{{ old('domicile') }}" required>
                <input type="email" name="email" placeholder="Email (halo@mail.com)" value="{{ old('email') }}" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                
                <div class="terms-container">
                    <div class="terms">
                        <input type="checkbox" id="terms_agreed" name="terms_agreed" required>
                        <label for="terms_agreed">Saya menyetujui syarat dan ketentuan</label>
                    </div>
                    <!-- Placeholder atau nonaktifkan dulu -->
                    <a href="#" class="forgot-password">Lupa kata sandi?</a>
                </div>
                <button type="submit" class="btn-daftar">Daftar</button>
                <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
            </form>
        </div>
    </div>
    <script>
  const dateInput = document.getElementById("birth_date");

  // Tambahkan placeholder semu
  dateInput.placeholder = "Tanggal Lahir";

  // Trik agar placeholder muncul saat value kosong
  dateInput.addEventListener("focus", function () {
    this.type = "date";
  });

  dateInput.addEventListener("blur", function () {
    if (!this.value) {
      this.type = "text";
    }
  });

  // Inisialisasi jika belum ada nilai
  if (!dateInput.value) {
    dateInput.type = "text";
  }
</script>
</body>
</html>