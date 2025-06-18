@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Tambah Data Penyewa</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.penyewa.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $kos->nama ?? '') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400" required>
        </div>

        <div>
            <label class="block text-gray-700">No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $kos->no_hp ?? '') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400" required>
        </div>

        <div>
            <label class="block text-gray-700">Jenis Kelamin</label>
            <select name="jenis_kelamin"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $kos->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $kos->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div>
            <label class="block text-gray-700">Kode Kamar</label>
            <input type="text" name="kode_kamar" value="{{ old('kode_kamar', $kos->kode_kamar ?? '') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400" required>
        </div>

        <div>
            <label class="block text-gray-700">Harga</label>
            <input type="number" name="harga" value="{{ old('harga', $kos->harga ?? '') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400" required>
        </div>

        <div>
            <label class="block text-gray-700">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $kos->tanggal_mulai ?? '') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400" required>
        </div>

        <div>
            <label class="block text-gray-700">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $kos->tanggal_selesai ?? '') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400">
        </div>

        <div>
            <label class="block text-gray-700">Status</label>
            <select name="status"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400" required>
                <option value="Masuk" {{ old('status', $kos->status ?? '') == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                <option value="Keluar" {{ old('status', $kos->status ?? '') == 'Keluar' ? 'selected' : '' }}>Keluar</option>
            </select>
        </div>

        <div class="flex justify-end space-x-2 pt-4">
            <a href="{{ route('admin.penyewa.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
               Batal
            </a>
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
