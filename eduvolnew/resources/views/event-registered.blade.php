<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Terdaftar</title>
    <link rel="stylesheet" href="{{ asset('css/event-registered.css') }}">
</head>
<body>
    <div class="container">
        <div class="left">
            <img src="{{ asset('images/Career progress-pana 1.png') }}" alt="Rocket Man" class="main-image">
        </div>
        <div class="right">
            <h1>
                Event Kamu <span class="highlight">"{{ $eventTitle }}"</span> <br>
                telah terdaftar!
            </h1>
            <p class="desc">
                Harap menunggu konfirmasi admin dengan <br>
                waktu pengerjaan paling lambat 24 jam
            </p>
            <a href="{{ url('/posting-event') }}" class="btn" style="text-decoration:none;display:inline-block;">Lihat Event Saya</a>
        </div>
    </div>
</body>
</html>
