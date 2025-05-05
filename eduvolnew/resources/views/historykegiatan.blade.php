@extends('layouts.app')
@include('layouts.sidebar')
@section('content')


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Event Saya</title>
    <link rel="stylesheet" href="{{ asset('css/historykegiatan.css') }}">
    <style>
        .detail-btn {y
            display: flex;
            align-items: center;
            gap: 10px;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            color: #3c28d4;
            padding: 6px 0;
        }

        .detail-btn .icon-eye {
            background-color: #3c28d4;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top: 48px; margin-left: 240px;">
        <div class="header" style="margin-bottom: 40px;">
            <div class="title-left">
                <span class="star">★</span>
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

        <div class="filter-box">
            <div class="filter-left">
                <span class="filter-label">Filter berdasarkan :</span>
                <label for="ongoing"><input type="checkbox" id="ongoing" name="status" value="ongoing"> On Going</label>
                <label for="coming"><input type="checkbox" id="coming" name="status" value="coming"> Coming Soon</label>
                <label for="ended"><input type="checkbox" id="ended" name="status" value="ended"> Ended</label>
            </div>
            <div class="filter-right">
                <button class="apply">Terapkan</button>
                <button class="reset">Hapus Filter</button>
            </div>
        </div>

        <table class="event-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Nama Event</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>
                            @php
                                $statusName = strtolower($event->status->name);
                            @endphp
                            @if($statusName == 'ongoing')
                                <span class="dot green"></span>
                            @elseif($statusName == 'published' || $statusName == 'coming soon')
                                <span class="dot orange"></span>
                            @elseif($statusName == 'completed' || $statusName == 'ended')
                                <span class="dot grey"></span>
                            @else
                                <span class="dot"></span>
                            @endif
                        </td>
                        <td>{{ $event->nama_event }}</td>
                        <td>
                            <a href="{{ route('history-kegiatan.show', $event->id) }}" class="detail-btn">
                                <span class="icon-eye">👁</span>
                                <span>Lihat Detail Event</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
@endsection