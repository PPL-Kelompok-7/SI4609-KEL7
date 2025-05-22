<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gunakan Voucher</title>
    <style>
        /* style sesuai keinginanmu, atau hapus kalau sudah ada CSS global */
    </style>
</head>
<body>
    <h1>Voucher Anda</h1>

    <div class="voucher-code">{{ strtoupper($voucher->code) }}</div>

    <p class="info">Potongan: {{ $voucher->discount_amount }}%</p>
    <p class="info">Berlaku sampai: {{ $voucher->valid_until ? $voucher->valid_until->format('d/m/Y') : '-' }}</p>

    <a href="{{ url()->previous() }}" class="back-link">&larr; Kembali ke daftar voucher</a>
</body>
</html>
