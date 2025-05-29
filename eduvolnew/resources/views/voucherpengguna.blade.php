<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Voucher Pelanggan</title>
    <link rel="stylesheet" href="{{ asset('css/voucheruser.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="voucher-icon">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                    <path d="M4 4H20V20H4V4Z" stroke="#000" stroke-width="2"/>
                    <!-- Tambahkan ikon sesuai kebutuhan -->
                </svg>
            </div>
            <h1 class="header-title">Voucher Saya</h1>
        </div>

        <div class="table-container">
            @if($vouchers->isEmpty())
                <p style="text-align:center; font-weight:bold; color:gray;">Belum ada voucher untuk {{ $user->first_name ?? 'Pengguna' }}</p>
            @else
                <table class="voucher-table">
                    <thead>
                        <tr>
                            <th>Kode Voucher</th>
                            <th>Nama Voucher</th>
                            <th>Tanggal Berlaku</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vouchers as $voucher)
                            <tr>
                                <td>
                                    @if($voucher->code === null)
                                        <form action="{{ route('voucherpengguna.generate', $voucher->id) }}" method="POST" onsubmit="return confirmGenerate()">
                                            @csrf
                                            <button type="submit" class="generate-btn">Generate Code</button>
                                        </form>
                                    @else
                                        {{ $voucher->code }}
                                    @endif
                                </td>
                                <td>{{ $voucher->voucherType->name ?? '-' }}</td>
                                <td>
                                    {{ $voucher->voucherType && $voucher->voucherType->valid_until 
                                        ? \Carbon\Carbon::parse($voucher->voucherType->valid_until)->format('d M Y') 
                                        : '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <script>
        function confirmGenerate() {
            return confirm('Yakin ingin generate code?');
        }
    </script>
</body>
</html>
