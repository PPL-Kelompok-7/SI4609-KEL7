<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Voucher All</title>
    <link rel="stylesheet" href="{{ asset('css/voucher.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="voucher-icon">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M33.3333 15.8333V11.6667C33.3333 10.7442 32.9821 9.8591 32.357 9.23398C31.7319 8.60886 30.8469 8.25767 29.9243 8.25767H10.0757C9.15314 8.25767 8.26809 8.60886 7.64297 9.23398C7.01785 9.8591 6.66666 10.7442 6.66666 11.6667V15.8333C7.58923 15.8333 8.47427 16.1845 9.09939 16.8096C9.72451 17.4347 10.0757 18.3198 10.0757 19.2423C10.0757 20.1649 9.72451 21.05 9.09939 21.6751C8.47427 22.3002 7.58923 22.6514 6.66666 22.6514V26.8333C6.66666 27.7558 7.01785 28.6409 7.64297 29.266C8.26809 29.8911 9.15314 30.2423 10.0757 30.2423H29.9243C30.8469 30.2423 31.7319 29.8911 32.357 29.266C32.9821 28.6409 33.3333 27.7558 33.3333 26.8333V22.6514C32.4108 22.6514 31.5257 22.3002 30.9006 21.6751C30.2755 21.05 29.9243 20.1649 29.9243 19.2423C29.9243 18.3198 30.2755 17.4347 30.9006 16.8096C31.5257 16.1845 32.4108 15.8333 33.3333 15.8333ZM23.3333 25H16.6667V22.5H23.3333V25ZM23.3333 20.8333H16.6667V18.3333H23.3333V20.8333ZM23.3333 16.6667H16.6667V14.1667H23.3333V16.6667Z" fill="white"/>
                </svg>
            </div>
            <h1 class="header-title">Voucher Saya</h1>
        </div>

        <div class="voucher-container">
            @foreach($vouchers as $voucher)
                <div class="voucher-card {{ $voucher->discount_amount >= 50 ? 'green' : 'pink' }}">
                    <div class="voucher-content">
                        <div class="voucher-title">
                            POTONGAN Rp{{ number_format($voucher->discount_amount, 0, ',', '.') }} UNTUK EVENT
                        </div>
                        <div class="voucher-validity">
                            Valid sampai : {{ $voucher->valid_until ? $voucher->valid_until->format('d/m/Y') : '-' }}
                        </div>
                        @if($voucher->is_active)
                            <a href="{{ route('voucher.use', $voucher->id) }}" class="voucher-button">
                                Gunakan Voucher
                            </a>
                        @else
                            <button class="voucher-button disabled" disabled>
                                Tidak Aktif
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
