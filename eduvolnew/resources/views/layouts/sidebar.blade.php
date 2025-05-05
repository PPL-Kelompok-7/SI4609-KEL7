{{-- resources/views/layouts/sidebar.blade.php --}}
<div class="custom-sidebar">
    <ul>
        <li class="{{ request()->is('history-kegiatan') ? 'active' : '' }}">
            <a href="{{ route('history-kegiatan.index') }}">Event Saya</a>
        </li>
        <li class="{{ request()->is('history-pembayaran') ? 'active' : '' }}">
            <a href="{{ route('history-pembayaran') }}">History Pembayaran</a>
        </li>
    </ul>
</div>

<style>
.custom-sidebar {
    position: fixed;
    top: 70px; /* sesuaikan dengan tinggi navbar */
    left: 0;
    width: 220px;
    height: calc(100vh - 70px);
    background: #4728f0;
    padding-top: 16px;
    z-index: 100;
    box-shadow: 2px 0 8px rgba(0,0,0,0.04);
}
.custom-sidebar ul {
    list-style: none;
    padding: 0 0 0 16px;
    margin: 24px 0 0 0;
}
.custom-sidebar li {
    margin-bottom: 12px;
}
.custom-sidebar a {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    display: block;
    padding: 8px 12px;
    border-radius: 6px;
    transition: background 0.2s;
}
.custom-sidebar .active a,
.custom-sidebar a:hover {
    background: #3c28d4;
    font-weight: bold;
}
@media (max-width: 900px) {
    .custom-sidebar {
        display: none;
    }
}
</style>