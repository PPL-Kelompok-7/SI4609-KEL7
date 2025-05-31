<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Ulasan Saya</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/isiulasansaya.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="main-container">

        <div class="container">
            <div class="review-card">
                <h2>Detail Ulasan Saya</h2>

                <p><strong>Relawan:</strong> {{ $review->full_name }}</p>
                <p><strong>Event:</strong> {{ $review->event_title }}</p>
                <p><strong>Rating:</strong> <span class="rating-display">{{ $review->rating }} / 10</span></p>
                <p><strong>Ulasan:</strong><br>{{ $review->ulasan }}</p>
                <p><strong>Diberikan pada:</strong> {{ \Carbon\Carbon::parse($review->created_at)->format('d M Y, H:i') }}</p>

                <a href="{{ route('ratingsaya.index') }}" class="btn btn-primary mt-3">← Kembali ke Rating Saya</a>
            </div>
        </div>
    </div>
</body>
</html>
