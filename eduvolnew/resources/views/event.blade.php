@extends('layouts.app')

@section('head')
    <title>Event Volunteer</title>
    <!-- Google Fonts - Poppins -->
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/event.css') }}">
@endsection

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<div class="container">
    <h2 style="margin-top:25px;"><span>Menampilkan</span> <strong>Event Volunteer</strong><br>yang dapat kamu ikuti</h2>

    <div class="event-grid">
        {{-- Event Card --}}
        @foreach ($events as $event)
            <div class="card">
                <img src="{{ !empty($event['event_photo']) ? asset('storage/' . $event['event_photo']) : asset('default-event.png') }}" alt="Event Image" class="event-image">
                
                <!-- Logo kecil di pojok kiri atas -->
                <div class="logo-circle">
                    <img src="{{ asset('images/logo-telkom-schools.png') }}" alt="Logo" style="width: 30px; height: 40px;">
                </div>

                <div class="card-content">
                    <div class="event-action-row" style="display: flex; align-items: center; gap: 12px;">
                        <span class="event-love" data-event-id="{{ $event['id'] }}" style="cursor: pointer;">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <circle cx="20" cy="20" r="20" fill="white"/>
                                <path d="M20 30C19.47 30 18.93 29.83 18.51 29.48C15.41 26.29 8 20.91 8 15.67C8 12.24 10.91 9.33 14.33 9.33C16.16 9.33 17.89 10.24 18.83 11.73C19.77 10.24 21.5 9.33 23.33 9.33C26.75 9.33 29.66 12.24 29.66 15.67C29.66 20.91 22.25 26.29 19.15 29.48C18.73 29.83 18.19 30 17.67 30H20Z" fill="#F44336"/>
                            </svg>
                        </span>
                        <a href="{{ route('event.detail', $event['id']) }}" class="participate-btn">Ikut Partisipasi</a>
                    </div>
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

    {{-- Popups (Keep within content section or adjust layout if needed) --}}
    <div id="popup-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1000;"></div>

    {{-- Confirmation Popup --}}
    <div id="confirm-add-popup" style="display: none; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); z-index: 1001; text-align: center; font-family: 'Poppins', sans-serif; max-width: 400px; width: 90%; height: fit-content;">
        {{-- Close button --}}
        
        <p style="font-size: 18px; margin-bottom: 20px; color: black;">Apakah Anda ingin menambahkan event ini ke wishlist?</p>
        <button id="yes-add-btn" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px; margin-right: 10px;">Ya</button>
        <button id="no-add-btn" style="background-color: #cccccc; color: black; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;">Batal</button>
    </div>

    {{-- Success Popup --}}
    <div id="wishlist-popup" style="display: none; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); z-index: 1001; text-align: center; font-family: 'Poppins', sans-serif; max-width: 400px; width: 90%; height: fit-content;">
        {{-- Close button --}}
        <span class="close-popup" style="position: absolute; top: 10px; right: 10px; font-size: 20px; cursor: pointer; color: #aaa;">&times;</span>
        <p style="font-size: 18px; margin-bottom: 20px; color: black; font-family: 'Poppins', sans-serif;">Event berhasil ditambahkan</p>
        <button id="go-to-wishlist" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;">Lihat Wishlist</button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const heartIcons = document.querySelectorAll('.event-love');
        const popup = document.getElementById('wishlist-popup');
        const overlay = document.getElementById('popup-overlay');
        const goToWishlistButton = document.getElementById('go-to-wishlist');
        const closePopupButton = document.querySelector('.close-popup');

        // Get references to the new confirmation popup elements
        const confirmAddPopup = document.getElementById('confirm-add-popup');
        const yesAddButton = document.getElementById('yes-add-btn');
        const noAddButton = document.getElementById('no-add-btn');
        const closeConfirmPopupButton = document.querySelector('.close-confirm-popup'); // Close button for confirmation popup

        let eventIdToAdd = null; // Variable to store the event ID to add

        function showSuccessPopup() {
            overlay.style.display = 'block';
            popup.style.display = 'block';
        }

        function hideSuccessPopup() {
            overlay.style.display = 'none';
            popup.style.display = 'none';
        }

        function showConfirmAddPopup() {
            overlay.style.display = 'block';
            confirmAddPopup.style.display = 'block';
        }

        function hideConfirmAddPopup() {
            overlay.style.display = 'none';
            confirmAddPopup.style.display = 'none';
            eventIdToAdd = null; // Reset event ID
        }

        heartIcons.forEach(icon => {
            icon.addEventListener('click', function () {
                eventIdToAdd = this.getAttribute('data-event-id');
                console.log('Event ID to add:', eventIdToAdd);

                // Show the confirmation popup instead of sending request directly
                showConfirmAddPopup();
            });
        });

        // Event listener for the "Ya" button in the confirmation popup
        if (yesAddButton) { // Check if element exists
            yesAddButton.addEventListener('click', function () {
                if (eventIdToAdd) {
                    console.log('Mengirim permintaan POST AJAX untuk Event ID:', eventIdToAdd);
                    fetch('{{ route('wishlist.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token for Laravel
                        },
                        body: JSON.stringify({ event_id: eventIdToAdd })
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideConfirmAddPopup(); // Hide confirmation popup
                        if (data.success) {
                            console.log('Penambahan ke wishlist sukses.');
                            showSuccessPopup(); // Show success popup
                        } else {
                            // Handle error (e.g., show a message that the event is already in the wishlist)
                            console.error('Failed to add to wishlist:', data.message);
                            alert(data.message); // Example: show an alert
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menambahkan ke wishlist.'); // Example: show an alert
                        hideConfirmAddPopup(); // Hide confirmation popup on error
                    });
                } else {
                    console.error('Tidak ada Event ID untuk ditambahkan.');
                    hideConfirmAddPopup(); // Hide confirmation popup if no event ID is set
                }
            });
        }

        // Event listeners for the "Batal" button and close button in the confirmation popup
        if (noAddButton) { // Check if element exists
            noAddButton.addEventListener('click', hideConfirmAddPopup);
        }
        if (closeConfirmPopupButton) { // Check if element exists (this one should be null now)
            closeConfirmPopupButton.addEventListener('click', hideConfirmAddPopup);
        }

        if (goToWishlistButton) { // Check if element exists
            goToWishlistButton.addEventListener('click', function () {
                window.location.href = '{{ url('/wishlist') }}'; // Replace with your actual wishlist URL
            });
        }

        // Close success pop-up when clicking outside or on its close button
        overlay.addEventListener('click', function(event) {
            // Only hide the currently displayed popup (either confirm or success)
            if (confirmAddPopup && confirmAddPopup.style.display === 'block') { // Check if confirmAddPopup exists
                hideConfirmAddPopup();
            } else if (popup && popup.style.display === 'block') { // Check if popup exists
                // Ensure the click was directly on the overlay, not bubbled from the popup
                if (event.target === overlay) {
                     hideSuccessPopup();
                }
            }
        });

        // Prevent closing when clicking inside the success pop-up itself
        if (popup) { // Check if element exists
            popup.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        }

        // Close success pop-up when clicking its close button (existing logic, ensuring it only hides success popup)
        if (closePopupButton) {
            closePopupButton.addEventListener('click', hideSuccessPopup);
        }

        // Prevent closing when clicking inside the confirmation pop-up itself
        if (confirmAddPopup) {
            confirmAddPopup.addEventListener('click', function(event) {
                 event.stopPropagation();
            });
        }
    });
</script>
@endpush