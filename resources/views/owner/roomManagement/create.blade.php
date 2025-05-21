@extends('layouts.index')

@section('header', 'Add Kamar Baru')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold text-orange-500 mb-4">Create Kamar Baru</h2>

        <form action="{{ route('manajemenKamar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nomor Kamar -->
            <div class="mb-4">
                <label for="nomor_kamar" class="block text-sm font-medium text-gray-700 mb-1">Nomor Kamar</label>
                <input type="text" name="nomor_kamar" id="nomor_kamar" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <!-- Harga Kamar -->
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="number" name="harga" id="harga" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    placeholder="0" min="0">
            </div>

            <!-- Tipe Kamar -->
            <div class="mb-4">
                <label for="tipe_kamar" class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
                <input type="text" name="tipe_kamar" id="tipe_kamar" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <!-- Gambar Kamar -->
            <div class="mb-6">
                <label for="gambar_kamar" class="block text-sm font-medium text-gray-700 mb-1">Gambar Kamar</label>
                <input type="file" name="gambar_kamar" id="gambar_kamar" accept="image/*"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <p class="text-xs text-gray-500 mt-1">Format File: .jpg/.png</p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between">
                <a href="{{ route('manajemenKamar.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-6 rounded-md">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-6 rounded-md">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection