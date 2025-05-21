@extends('layouts.index')

@section('header', 'Edit Room')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold text-orange-500 mb-4">Edit Kamar</h2>

        <form action="{{ route('manajemenKamar.update', $kamar->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nomor Kamar -->
            // Jika Terisi, nomor kamar tidak bisa diubah
            <div class="mb-4">
                <label for="nomor_kamar" class="block text-sm font-medium text-gray-700 mb-1">Nama Kamar</label>
                <input type="text" name="nomor_kamar" id="nomor_kamar" value="{{ $kamar->nomor_kamar }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    {{ $kamar->status == 'terisi' ? 'readonly' : '' }}>
            </div>

            <!-- Harga Kamar -->
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="number" name="harga" id="harga" value="{{ $kamar->harga }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    placeholder="0" min="0">
            </div>

            <!-- Status Kamar -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <option value="belum_terisi" {{ $kamar->status === 'belum_terisi' ? 'selected' : '' }}>Tidak Terisi</option>
                    <option value="terisi" {{ $kamar->status === 'terisi' ? 'selected' : '' }}>Terisi</option>
                </select>
            </div>

            <!-- Informasi Penyewa -->
            @if ($kamar->status == 'terisi' && isset($kamar->user))
            <div class="mb-4 p-3 bg-gray-50 rounded-md">
                <p class="text-sm text-gray-700 font-medium">Penyewa Saat Ini:</p>
                <p class="text-sm text-gray-600">
                    {{ $kamar->user->nama ?? '-' }}
                </p>
            </div>
            @endif

            <!-- Tipe Kamar -->
            <div class="mb-4">
                <label for="tipe_kamar" class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
                <input type="text" name="tipe_kamar" id="tipe_kamar" value="{{ $kamar->tipe_kamar }}""
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    {{ $kamar->tipe_kamar }}>
            </div>

            <!-- Gambar Kamar -->
            <div class="mb-6">
                <label for="gambar_kamar" class="block text-sm font-medium text-gray-700 mb-1">Gambar Kamar</label>
                <input type="file" name="gambar_kamar" id="gambar_kamar" accept="image/*"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <p class="text-xs text-gray-500 mt-1">Format File: .jpg/.png</p>

                @if ($kamar->gambar_kamar)
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Gambar Saat ini:</p>
                    <img src="/storage/{{ $kamar->gambar_kamar }}" alt="Current Room Image"
                        class="mt-1 h-24 object-cover rounded">
                </div>
                @endif
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between">
                <a href="{{ route('manajemenKamar.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-6 rounded-md">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-6 rounded-md">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection