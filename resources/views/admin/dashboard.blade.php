@extends('layouts.app')

@section('header', 'Dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold text-center text-orange-500 mb-6">SELAMAT DATANG ADMIN!</h1>

    <!-- Kotak Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-yellow-100 text-center p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-orange-500 mb-2">Total Kamar</h2>
            <p class="text-4xl font-bold text-orange-600">{{ $totalKamar }}</p>
        </div>
        <div class="bg-yellow-100 text-center p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-orange-500 mb-2">Kamar Terisi</h2>
            <p class="text-4xl font-bold text-orange-600">{{ $kamarTerisi }}</p>
        </div>
        <div class="bg-yellow-100 text-center p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-orange-500 mb-2">Kamar Kosong</h2>
            <p class="text-4xl font-bold text-orange-600">{{ $kamarKosong }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Notifikasi -->
<div class="bg-yellow-100 rounded-lg shadow">
    <div class="bg-yellow-200 text-orange-500 font-semibold px-4 py-2 rounded-t-lg">
        Notifikasi
    </div>
    <div class="p-4">
        @forelse ($notifikasi as $notif)
            <div class="flex items-start gap-3 mb-4 border-b pb-2 border-orange-200">
                <img src="{{ $notif->user->profile_photo_url ?? '/default-user.png' }}" alt="User" class="w-8 h-8 rounded-full mt-1">
                <div>
                    <p class="font-semibold text-orange-600">{{ $notif->user->name ?? 'User #' . $notif->user_id }}</p>
                    <p class="text-gray-800">{{ $notif->pesan }}</p>
                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($notif->waktu_kirim)->format('d M Y, H:i') }}</p>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Tidak ada notifikasi terbaru.</p>
        @endforelse
    </div>
</div>


        <!-- Jadwal Pemeliharaan -->
<div class="bg-yellow-100 rounded-lg shadow">
    <div class="bg-yellow-200 text-orange-500 font-semibold px-4 py-2 rounded-t-lg">
        Jadwal Pemeliharaan
    </div>
    <div class="p-4">
        @forelse ($jadwalPemeliharaan as $jadwal)
            <div class="mb-4 border-b border-orange-200 pb-2">
                <p class="text-orange-600 font-semibold">
                    Kamar {{ $jadwal->kamar->no_kamar ?? 'Tanpa Nama' }}
                </p>
                <p class="text-sm text-gray-700">{{ $jadwal->keterangan }}</p>
                <p class="text-sm text-gray-500">Dibuat: {{ $jadwal->created_at->format('d M Y, H:i') }}</p>
            </div>
        @empty
            <p class="text-gray-500">Tidak ada jadwal pemeliharaan.</p>
        @endforelse
    </div>
</div>

    </div>
</div>
@endsection
