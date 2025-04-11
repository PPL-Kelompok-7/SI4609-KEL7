<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - EDU Volunteer</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>
<body>
  <div class="container">
    <div class="left-section">
      <div class="left-top">
        <p class="promo-text">
          Jadilah bagian dari <br />
          <span class="highlight">#RelawanPintar</span><br />
          sekarang juga!
        </p>
      </div>
      <div class="left-bottom">
        <img src="{{ asset('logo2.png') }}" alt="Anak-anak belajar" class="child-img" />
      </div>
    </div>

    <div class="right-section">
      <div class="form-wrapper">
        <img src="{{ asset('logo1.png') }}" alt="Logo EDU Volunteer" class="logo-img" />
        <h2 class="welcome-text">Selamat Datang!</h2>
        <p>Mari Mulai Perjalananmu</p>
        <form id="loginForm" method="POST" action="{{ route('login') }}">
          @csrf
          <input type="email" name="email" placeholder="Email" required />
          <input type="password" name="password" placeholder="Kata Sandi" required />
          <div class="options">
            <label class="remember-me">
              <input type="checkbox" name="remember" /> <span>Ingat untuk 30 hari</span>
            </label>
            <a href="#" class="forgot">Lupa kata sandi?</a>
          </div>
          <button type="submit">Masuk</button>
        </form>
        <p class="signup-text">
          Belum punya akun?
          <a href="{{ route('register') }}" class="signup-link">Daftar</a>
        </p>
      </div>
    </div>

  </div>
  <script src="{{ asset('script.js') }}"></script>
</body>
</html>