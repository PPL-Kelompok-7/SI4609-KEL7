@extends('layouts.app')
@include('layouts.sidebar')

@section('css')
<link rel="stylesheet" href="{{ asset('css/wishlist.css') }}">
@endsection

@section('content')
<div class="wishlist-container with-sidebar">
    <div class="wishlist-header" style="display: flex; align-items: center; gap: 10px; margin-left: 24px;">
        <span class="wishlist-star" style="display: flex; align-items: center;">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <polygon points="16,4 20,13 30,13 22,19 25,28 16,22 7,28 10,19 2,13 12,13" fill="white"/>
            </svg>
        </span>
        <span class="wishlist-title"><span class="wishlist-title-green">Event Favorit</span> Saya</span>
    </div>
    <!-- <div class="wishlist-desc">Daftar event yang ditandai sebagai favorit</div> -->
    <div class="wishlist-grid">
        @foreach ($events as $event)
        <div class="wishlist-card" data-event-id="{{ $event->id }}">
            <div class="wishlist-card-img-wrapper">
                <img src="{{ !empty($event->event_photo) ? asset('storage/' . $event->event_photo) : asset('default-event.png') }}" alt="Event" class="wishlist-card-img">
                {{-- Jika ingin menampilkan logo kecil di pojok kiri atas, tambahkan di sini --}}
                {{-- <img src="/logo0.png" alt="Logo" class="wishlist-card-logo"> --}}
                <div class="wishlist-card-label">{{ $event->title }}</div>
            </div>
            <div class="wishlist-card-bottom">
                {{-- Tombol heart di wishlist untuk menghapus --}}
                <div class="wishlist-card-heart delete-wishlist" style="cursor: pointer;">
                    {{-- Menggunakan ikon heart --}}
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <circle cx="20" cy="20" r="20" fill="white"/>
                        <path d="M20 30C19.47 30 18.93 29.83 18.51 29.48C15.41 26.29 8 20.91 8 15.67C8 12.24 10.91 9.33 14.33 9.33C16.16 9.33 17.89 10.24 18.83 11.73C19.77 10.24 21.5 9.33 23.33 9.33C26.75 9.33 29.66 12.24 29.66 15.67C29.66 20.91 22.25 26.29 19.15 29.48C18.73 29.83 18.19 30 17.67 30H20Z" fill="#F44336"/>
                    </svg>
                </div>
                <div class="wishlist-card-info">
                    <div class="wishlist-card-title"><a href="{{ route('event.detail', $event->id) }}" style="text-decoration: none; color: inherit;">{{ $event->title }}</a></div>
                    <div class="wishlist-card-meta">
                        <span><i class="fa fa-tag"></i> Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                        <span><i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($event->start_date)->format('d F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Custom Delete Confirmation Popup --}}
<div id="delete-popup-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1000;"></div>
<div id="delete-wishlist-popup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); z-index: 1001; text-align: center; font-family: 'Poppins', sans-serif;">
    <p style="font-size: 18px; margin-bottom: 20px; color: black;">Apakah Anda yakin ingin menghapus event ini dari wishlist?</p>
    <button id="confirm-delete-btn" style="background-color: #F44336; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px; margin-right: 10px;">Ya, Hapus</button>
    <button id="cancel-delete-btn" style="background-color: #cccccc; color: black; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;">Batal</button>
</div>

@endsection

@push('scripts')
<script>
    console.log('Script wishlist dimuat.');
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOMContentLoaded terpicu.');
        const deleteButtons = document.querySelectorAll('.delete-wishlist');
        console.log('Tombol delete ditemukan:', deleteButtons.length);

        // Get references to the custom popup elements
        const deletePopupOverlay = document.getElementById('delete-popup-overlay');
        const deleteWishlistPopup = document.getElementById('delete-wishlist-popup');
        const confirmDeleteButton = document.getElementById('confirm-delete-btn');
        const cancelDeleteButton = document.getElementById('cancel-delete-btn');

        let eventIdToDelete = null; // Variable to store the event ID to delete
        let cardToDelete = null; // Variable to store the card element to remove

        function showDeletePopup() {
            deletePopupOverlay.style.display = 'block';
            deleteWishlistPopup.style.display = 'block';
        }

        function hideDeletePopup() {
            deletePopupOverlay.style.display = 'none';
            deleteWishlistPopup.style.display = 'none';
            eventIdToDelete = null; // Reset event ID
            cardToDelete = null; // Reset card element
        }

        deleteButtons.forEach(button => {
            console.log('Menambahkan event listener ke tombol:', button);
            button.addEventListener('click', function () {
                console.log('Tombol delete diklik.');
                const card = this.closest('.wishlist-card');
                eventIdToDelete = card.getAttribute('data-event-id');
                cardToDelete = card; // Store the card element
                console.log('Event ID to delete:', eventIdToDelete);

                // Show the custom confirmation popup
                showDeletePopup();
            });
        });

        // Event listener for the "Ya, Hapus" button in the custom popup
        confirmDeleteButton.addEventListener('click', function () {
            if (eventIdToDelete) {
                console.log('Mengirim permintaan DELETE AJAX untuk Event ID:', eventIdToDelete);
                fetch('{{ url('/wishlist') }}/' + eventIdToDelete, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    console.log('Respons diterima:', response);
                    return response.json();
                })
                .then(data => {
                    console.log('Data respons:', data);
                    if (data.success) {
                        console.log('Penghapusan sukses, menghapus card dari DOM.');
                        if (cardToDelete) {
                            cardToDelete.remove(); // Remove the event card from the DOM
                        }
                        console.log(data.message); // Log success message to console
                        hideDeletePopup(); // Hide the popup after successful deletion
                    } else {
                        console.log('Penghapusan gagal.', data.message);
                        alert('Gagal menghapus event dari wishlist: ' + data.message);
                        hideDeletePopup(); // Hide the popup even if deletion failed
                    }
                })
                .catch(error => {
                    console.error('Error pada permintaan fetch:', error);
                    alert('Terjadi kesalahan saat menghapus event dari wishlist.');
                    hideDeletePopup(); // Hide the popup on error
                });
            } else {
                console.error('Tidak ada Event ID untuk dihapus.');
                hideDeletePopup(); // Hide the popup if no event ID is set
            }
        });

        // Event listener for the "Batal" button and overlay to close the popup
        cancelDeleteButton.addEventListener('click', hideDeletePopup);
        deletePopupOverlay.addEventListener('click', hideDeletePopup);

        // Optional: Prevent closing when clicking inside the popup itself
        deleteWishlistPopup.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
</script>
@endpush
