@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Buat Notifikasi Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.notifikasi.store') }}" method="POST" class="bg-white shadow-md rounded px-6 py-4">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">User ID (kosongkan untuk semua user)</label>
            <input type="number" name="user_id" value="{{ old('user_id') }}"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-orange-300">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Pesan</label>
            <textarea name="pesan" rows="4" required
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-orange-300">{{ old('pesan') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Status</label>
            <select name="status" required
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-orange-300">
                <option value="terkirim" {{ old('status') == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                <option value="dibaca" {{ old('status') == 'dibaca' ? 'selected' : '' }}>Dibaca</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Waktu Kirim</label>
            <input type="datetime-local" name="waktu_kirim" required value="{{ old('waktu_kirim') }}"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-orange-300">
        </div>

        <div class="flex gap-3">
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded shadow">
                Simpan
            </button>
            <a href="{{ route('admin.notifikasi.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded shadow">
                Batal
            </a>
        </div>
    </form>
@endsection
