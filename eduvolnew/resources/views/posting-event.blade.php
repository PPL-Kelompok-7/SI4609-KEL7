@extends('layouts.mitra')

@section('title', 'Event Saya')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/posting-event.css') }}">
@endsection

@section('content')


<body>
    <div class="main-layout">
        
        <!-- Main Content Area -->
        <div style="flex:1;">
           

            <!-- Main Content (existing) -->
            <div class="main-content">
                <!-- Existing content starts here -->
                <div class="container">
                    <div class="header">
                        <div class="title-left">
                        <img src="{{ asset('images/star.png') }}" alt="Star Icon" style="width: 32px; height: 32px;">
                            <span class="title-text"><span class="green">Event</span> Saya</span>
                        </div>
                        <div class="status-summary">
                            <div class="status-box">
                                <span class="dot green"></span>
                                <div><strong>2</strong><br>On Going</div>
                            </div>
                            <div class="status-box">
                                <span class="dot orange"></span>
                                <div><strong>1</strong><br>Coming Soon</div>
                            </div>
                            <div class="status-box">
                                <span class="dot grey"></span>
                                <div><strong>10</strong><br>Ended</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Tambah Event -->
                    <div class="add-event-container">
                        <a href="{{ url('/formposting-event') }}" class="add-event-btn" style="text-decoration:none;display:inline-block;">Tambah Event</a>
                    </div>

                    <table class="event-table">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Nama Event</th>
                                <th>Status Konfirmasi</th> <!-- Tambahan -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>
                                    <span class="dot {{ $event['status'] }}"></span>
                                </td>
                                <td>{{ $event['title'] }}</td>
                                <td>
                                    <span class="confirmation {{ $event['status_id'] == 7 ? 'confirmed' : 'pending' }}">
                                        {{ $event['status_id'] == 7 ? 'Sudah Dikonfirmasi' : 'Belum Dikonfirmasi' }}
                                    </span>
                                </td>
                                <td>
                                    {{-- Bungkus tombol dengan tag anchor --}}
                                    <a href="{{ route('event.detail.mitra', $event['id']) }}" style="text-decoration: none;"> 
                                        <button class="detail-btn">
                                            <span class="icon-eye">👁</span>
                                            <span>Lihat Detail Event</span>
                                        </button>
                                    </a> 
                                    {{-- Tombol Hapus (Muncul di setiap event) --}}
                                    <form action="{{ route('posting-event.destroy', $event['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">
                                            <img src="{{ asset('images/filled-trash.png') }}" alt="Trash Icon" class="icon-trash-img">
                                            <span>Hapus Event</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Existing content ends here -->
            </div>
        </div>
    </div>
</body>

</html>