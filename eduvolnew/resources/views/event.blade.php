<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Event Volunteer</title>
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
</head>
<body>
    <div class="container">
        <h2><span>Menampilkan</span> <strong>Event Volunteer</strong><br>yang dapat kamu ikuti</h2>

        <div class="event-grid">
            {{-- Event Card --}}
            @foreach ($events as $event)
                <div class="card">
                    <img src="{{ asset($event['image']) }}" alt="Event Image" class="event-image">
                    
                    <!-- Logo kecil di pojok kiri atas -->
                    <div class="logo-circle">
                        <img src="{{ asset('images/logo-telkom-schools.png') }}" alt="Logo" style="width: 30px; height: 40px;">
                    </div>

                    <div class="card-content">
                        <button class="participate-btn">Ikut Partisipasi</button>
                        <div class="card-details">
                            <h3>{{ $event['title'] }}</h3>
                            <div class="event-info">
                                <div class="info">
                                    <img src="{{ asset('images/price-tag.png') }}" alt="Price Icon">
                                    <span>{{ $event['price'] }}</span>
                                </div>
                                <div class="info">
                                    <img src="{{ asset('images/task.png') }}" alt="Task Icon">
                                    <span>{{ $event['date'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>

        <!-- <footer class="footer">
    <div class="footer-left">
        <img src="{{ asset('images/logo1.png') }}" alt="Logo EduVolunteer" class="eduv-logo">
        <div class="contact-info">
            <div class="location">
                <img src="{{ asset('images/location.png') }}" alt="Location Icon">
                Bandung, Indonesia
            </div>
            <div class="phone">
                <img src="{{ asset('images/viber.png') }}" alt="Phone Icon">
                0821-1234-5678
            </div>
        </div>
    </div>
    <button class="start-btn">
        <img src="{{ asset('images/logostart.png') }}" alt="Start Icon">
        Mulai Perjalananmu
    </button>
</footer> -->
    </div>
</body>
</html>
