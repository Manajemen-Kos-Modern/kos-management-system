@extends('layouts.app')

@section('content')
<h1>Notifikasi Kamu</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Pesan</th>
            <th>Status</th>
            <th>Waktu Kirim</th>
        </tr>
    </thead>
    <tbody>
        @forelse($notifikasis as $notif)
        <tr>
            <td>{{ $notif->pesan }}</td>
            <td>{{ $notif->status }}</td>
            <td>{{ $notif->waktu_kirim }}</td>
        </tr>
        @empty
        <tr><td colspan="3">Belum ada notifikasi</td></tr>
        @endforelse
    </tbody>
</table>

{{ $notifikasis->links() }}
@endsection
