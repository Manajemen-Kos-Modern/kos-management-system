@extends('layouts.index')

@section('header', 'Edit Jadwal Pemeliharaan')

@section('content')
    <div class="mb-4">
        <a href="{{ route('jadwalPemeliharaan.show', $pemeliharaan->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-yellow-50">
            <h2 class="text-lg font-semibold text-yellow-800">Edit Jadwal Pemeliharaan</h2>
        </div>
        
        <div class="p-6">
            <form action="{{ route('jadwalPemeliharaan.update', $pemeliharaan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="kamar_id" class="block text-sm font-medium text-gray-700 mb-1">Kamar</label>
                    <select id="kamar_id" name="kamar_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm rounded-md @error('kamar_id') border-red-500 @enderror">
                        <option value="">-- Pilih Kamar --</option>
                        @foreach ($kamars as $kamar)
                            <option value="{{ $kamar->id }}" {{ (old('kamar_id') ?? $pemeliharaan->kamar_id) == $kamar->id ? 'selected' : '' }}>
                                {{ $kamar->nama_kamar ?? 'Kamar #'.$kamar->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('kamar_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="hari" class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
                        <select id="hari" name="hari" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm rounded-md @error('hari') border-red-500 @enderror">
                            <option value="">-- Pilih Hari --</option>
                            @foreach ($days as $day)
                                <option value="{{ $day }}" {{ (old('hari') ?? $scheduledDay) == $day ? 'selected' : '' }}>{{ $day }}</option>
                            @endforeach
                        </select>
                        @error('hari')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="jam" class="block text-sm font-medium text-gray-700 mb-1">Jam</label>
                        <select id="jam" name="jam" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm rounded-md @error('jam') border-red-500 @enderror">
                            <option value="">-- Pilih Jam --</option>
                            @foreach ($times as $time)
                                <option value="{{ $time }}" {{ (old('jam') ?? $scheduledTime) == $time ? 'selected' : '' }}>{{ $time }}</option>
                            @endforeach
                        </select>
                        @error('jam')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm rounded-md @error('status') border-red-500 @enderror">
                        <option value="sedang-proses" {{ (old('status') ?? $pemeliharaan->status) == 'sedang-proses' ? 'selected' : '' }}>Sedang Proses</option>
                        <option value="selesai" {{ (old('status') ?? $pemeliharaan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm @error('keterangan') border-red-500 @enderror">{{ old('keterangan') ?? $pemeliharaan->keterangan }}</textarea>
                    @error('keterangan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection