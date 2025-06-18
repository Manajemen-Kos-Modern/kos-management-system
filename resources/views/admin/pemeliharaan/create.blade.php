@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-xl p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Tambah Data Pemeliharaan</h2>
            <a href="{{ route('admin.pemeliharaan.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.pemeliharaan.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Pilih Kamar -->
            <div>
                <label for="kamar_id" class="block text-sm font-medium text-gray-700 mb-1">Kamar</label>
                <select id="kamar_id" name="kamar_id" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('kamar_id') border-red-500 @enderror">
                    <option value="">-- Pilih Kamar --</option>
                    @foreach($kamars as $kamar)
                        <option value="{{ $kamar->id }}" {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}>
                            Kamar {{ $kamar->nomor_kamar }} - {{ $kamar->tipe }}
                        </option>
                    @endforeach
                </select>
                @error('kamar_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" name="status" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                    <option value="sedang-proses" {{ old('status') == 'sedang-proses' ? 'selected' : '' }}>Sedang Proses</option>
                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan -->
            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="3" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('keterangan') border-red-500 @enderror">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex justify-start space-x-3 pt-4">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Simpan
                </button>
                <a href="{{ route('admin.pemeliharaan.index') }}"
                    class="border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
