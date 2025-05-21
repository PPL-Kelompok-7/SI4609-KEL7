    <link rel="stylesheet" href="{{ asset('css/navbarmitra.css') }}">
      
      
      <div class="sidebar">
            <div class="menu">
                <a href="{{ url('/posting-event') }}" class="menu-item {{ request()->is('posting-event') ? 'active' : '' }}">Event Saya</a>
                <a href="{{ url('/ratingrelawan') }}" class="menu-item {{ request()->is('ratingrelawan') ? 'active' : '' }}">Rating Relawan</a>
                <a href="{{ url('/notifikasi') }}" class="menu-item {{ request()->is('notifikasi') ? 'active' : '' }}">Notifikasi</a>


            </div>
        </div>