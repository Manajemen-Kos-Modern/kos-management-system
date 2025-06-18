@extends('layouts.app')

@section('title', 'Edit Notifikasi')

@section('content')
<div class="max-w-2xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Notifikasi</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.notifikasi.update', $notifikasi->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="user_id" class="block font-semibold mb-1">User</label>
            <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300" required>
                <option value="">-- Pilih User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $notifikasi->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="pesan" class="block font-semibold mb-1">Pesan</label>
            <textarea name="pesan" id="pesan" rows="3" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300" required>{{ old('pesan', $notifikasi->pesan) }}</textarea>
        </div>

        <div>
            <label for="status" class="block font-semibold mb-1">Status</label>
            <select name="status" id="status" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300" required>
                <option value="terkirim" {{ $notifikasi->status == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                <option value="dibaca" {{ $notifikasi->status == 'dibaca' ? 'selected' : '' }}>Dibaca</option>
            </select>
        </div>

        <div>
            <label for="waktu_kirim" class="block font-semibold mb-1">Waktu Kirim</label>
            <input type="datetime-local" name="waktu_kirim" id="waktu_kirim"
                value="{{ old('waktu_kirim', date('Y-m-d\TH:i', strtotime($notifikasi->waktu_kirim))) }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300" required>
        </div>

        <div class="flex gap-3 mt-4">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded shadow">
                Update Notifikasi
            </button>
            <a href="{{ route('admin.notifikasi.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded shadow">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
