<div class="sidebar">
    <ul class="sidebar-menu">
        {{-- Dashboard tanpa route, kosongin href --}}
        <li>
            <a href="#">Dashboard</a>
        </li>

        {{-- Verifikasi Pembayaran pakai route kalau sudah ada --}}
        <li class="{{ request()->routeIs('verifbayar') ? 'active' : '' }}">
            <a href="{{ route('verifbayar') }}">Verifikasi Pembayaran</a>
        </li>

        {{-- Verifikasi Event pakai route kalau sudah ada --}}
        <li class="{{ request()->routeIs('verification.event.index') ? 'active' : '' }}">
            <a href="{{ route('verification.event.index') }}">Verifikasi Event</a>
        </li>

        {{-- Notifikasi tanpa route --}}
        <li>
            <a href="#">Notifikasi</a>
        </li>

        {{-- Voucher pakai route kalau sudah ada --}}
        <li class="{{ request()->routeIs('voucherall.index') ? 'active' : '' }}">
            <a href="{{ route('voucherall.index') }}">Voucher</a>
        </li>
    </ul>
</div>
