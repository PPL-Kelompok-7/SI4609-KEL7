<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Voucher</title>
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
</head>
<body>
    <div class="container">
        <h1>Voucher Terkirim!</h1>
        <p>Voucher dengan kode <strong>{{ strtoupper($kode) }}</strong> telah berhasil dikirimkan kepada user <strong>{{ $nama }}</strong> dari user_id <strong>{{ $user_id }}</strong>.</p>
        
        <a href="{{ route('voucherall.index') }}" class="btn-kembali">Kembali ke All Voucher</a>
    </div>
</body>
</html>
