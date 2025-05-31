   <link rel="stylesheet" href="{{ asset('css/navbarmitra.css') }}">

<div class="navbar-top">
                <div class="navbar-left">
                    <img src="{{ asset('images/EDUVOL LOGO 1.png') }}" alt="EDU Volunteer" class="eduvol-logo">
                </div>
                <div class="school">
                    <div class="school-logo-circle">
                        <img src="{{ asset('images\logo-telkom-schools.png') }}" alt="SMK Telkom Bandung">
                    </div>
                    <span class="school-name">SMK Telkom Bandung</span>
                </div>
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            </div>