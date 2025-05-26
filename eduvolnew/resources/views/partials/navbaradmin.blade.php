{{-- Navbar (sesuaikan jika navbar terpisah) --}}
    <nav class="navbar">
        <div class="navbar-left">
            <img src="{{ asset('EDUVOL LOGO 1.png') }}" alt="EDU Volunteer Logo" class="logo" style="height:40px;margin-right:10px;">
        </div>
        <div class="navbar-right">
            <span style="color:white;font-size:16px;">Hi, Admin <b>{{ Auth::user()->first_name ?? 'Admin' }}</b></span>
            {{-- Tambahkan form logout jika diperlukan --}}
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
             <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</button>
        </div>
    </nav>