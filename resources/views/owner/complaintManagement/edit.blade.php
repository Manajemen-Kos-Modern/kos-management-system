@extends('layouts.index')

@section('header', 'Edit Keluhan')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('manajemenKeluhan.update', $keluhan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 font-medium mb-2">Pengguna</label>
                <select id="user_id" name="user_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('user_id') border-red-500 @enderror">
                    <option value="">Pilih Pengguna</option>
                    @foreach(\App\Models\User::all() as $user)
                        <option value="{{ $user->id }}" {{ $keluhan->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="kamar_id" class="block text-gray-700 font-medium mb-2">Kamar</label>
                <select id="kamar_id" name="kamar_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('kamar_id') border-red-500 @enderror">
                    <option value="">Pilih Kamar</option>
                    @foreach(\App\Models\Kamar::all() as $kamar)
                        <option value="{{ $kamar->id }}" {{ $keluhan->kamar_id == $kamar->id ? 'selected' : '' }}>{{ $kamar->nomor_kamar }}</option>
                    @endforeach
                </select>
                @error('kamar_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="jenis_keluhan" class="block text-gray-700 font-medium mb-2">Jenis Keluhan</label>
                <input type="text" id="jenis_keluhan" name="jenis_keluhan" value="{{ old('jenis_keluhan', $keluhan->jenis_keluhan) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('jenis_keluhan') border-red-500 @enderror">
                @error('jenis_keluhan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="keterangan" class="block text-gray-700 font-medium mb-2">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('keterangan') border-red-500 @enderror">{{ old('keterangan', $keluhan->keterangan) }}</textarea>
                @error('keterangan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end">
                <a href="{{ route('manajemenKeluhan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg mr-2">Batal</a>
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
@endsection