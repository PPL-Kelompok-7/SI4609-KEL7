{{-- resources/views/layouts/sidebar.blade.php --}}
<div class="sidebar">
    <ul class="sidebar-menu">
        <li class="sidebar-item {{ Request::is('history-kegiatan*') ? 'active' : '' }}">
            <a href="{{ route('history-kegiatan.index') }}">Event Saya</a>
        </li>
        <li class="sidebar-item {{ Request::is('wishlist*') ? 'active' : '' }}">
            <a href="{{ route('wishlist.index') }}">Wishlist Event</a>
        </li>
        <li class="sidebar-item {{ Request::is('history-pembayaran') ? 'active' : '' }}">
            <a href="{{ route('history-pembayaran') }}">History Pembayaran</a>
        </li>
        <li class="sidebar-item">
            <a href="#">Voucher Saya</a>
        </li>
        <li class="sidebar-item">
            <a href="#">Rating Saya</a>
        </li>
    </ul>
</div>