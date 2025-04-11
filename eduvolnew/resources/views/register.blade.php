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
                <div class="input-group">
                    <input type="text" name="first_name" placeholder="Nama Depan" value="{{ old('first_name') }}" required>
                    <input type="text" name="last_name" placeholder="Nama Belakang" value="{{ old('last_name') }}" required>
                </div>
                <div class="input-group">
                    <input type="date" name="birth_date" placeholder="Tanggal Lahir" value="{{ old('birth_date') }}" required>
                    <input type="text" name="profession" placeholder="Profesi" value="{{ old('profession') }}" required>
                </div>
                <input type="text" name="domicile" placeholder="Domisili" value="{{ old('domicile') }}" required>
                <input type="email" name="email" placeholder="Email (halo@mail.com)" value="{{ old('email') }}" required>
                <input type="password" name="password" placeholder="Password" required>
            </form>
        </div>
    </div>
</body>
</html>
