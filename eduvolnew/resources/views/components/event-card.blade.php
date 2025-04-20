event-card.blade.php
<div class="event-card-new position-relative">
    <img src="{{ asset($banner) }}" alt="{{ $title }}" class="img-fluid" style="width: 100%; height: 180px; object-fit: cover; border-radius: 10px;">
    
    <div class="mt-2 text-white position-relative" style="padding-right: 60px;"> <!-- kasih padding supaya teks tidak tertimpa logo -->
        <h5 class="event-title mb-1">{{ $title }}</h5>
        <div class="mb-1"><i class="fas fa-star"></i> {{ $rating }}</div>
        <div><i class="fas fa-calendar-alt"></i> {{ $date }}</div>
    </div>

    <!-- Logo vendor di pojok kanan bawah -->
    <img src="{{ asset($vendor) }}" alt="vendor" class="vendor-logo position-absolute" style="bottom: 10px; right: 10px; width: 50px; height: 50px; border-radius: 50%;">
</div>