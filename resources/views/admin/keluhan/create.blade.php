@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Buat Keluhan Baru</h2>

    <form action="{{ route('admin.keluhan.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="user_id" class="block mb-1">Pengguna</label>
            <select name="user_id" id="user_id" class="w-full border rounded p-2" required>
                <option value="">-- Pilih Pengguna --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->nama }}
                    </option>
                @endforeach
            </select>
            @error('user_id')<small class="text-red-600">{{ $message }}</small>@enderror
        </div>

        <div class="mb-4">
            <label for="kamar_id" class="block mb-1">Kamar</label>
            <select name="kamar_id" id="kamar_id" class="w-full border rounded p-2" required>
                <option value="">-- Pilih Kamar --</option>
                @foreach($kamars as $kamar)
                    <option value="{{ $kamar->id }}" {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}>
                        Kamar {{ $kamar->nama ?? 'ID '.$kamar->id }}
                    </option>
                @endforeach
            </select>
            @error('kamar_id')<small class="text-red-600">{{ $message }}</small>@enderror
        </div>

        <div class="mb-4">
    <label for="jenis_keluhan" class="block mb-1">Jenis Keluhan</label>
    <select name="jenis_keluhan" id="jenis_keluhan" class="w-full border rounded p-2" required>
        <option value="">-- Pilih Jenis Keluhan --</option>
        <option value="AC" {{ old('jenis_keluhan') == 'AC' ? 'selected' : '' }}>AC</option>
        <option value="Fasilitas" {{ old('jenis_keluhan') == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
        <option value="Listrik" {{ old('jenis_keluhan') == 'Listrik' ? 'selected' : '' }}>Listrik</option>
        <option value="Kebersihan" {{ old('jenis_keluhan') == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
        <option value="Air" {{ old('jenis_keluhan') == 'Air' ? 'selected' : '' }}>Air</option>
    </select>
    @error('jenis_keluhan')<small class="text-red-600">{{ $message }}</small>@enderror
</div>


        <div class="mb-4">
            <label for="keterangan" class="block mb-1">Keterangan</label>
            <textarea name="keterangan" id="keterangan" rows="4" class="w-full border rounded p-2" required>{{ old('keterangan') }}</textarea>
            @error('keterangan')<small class="text-red-600">{{ $message }}</small>@enderror
        </div>

        <div class="mb-4">
            <label for="status" class="block mb-1">Status</label>
            <select name="status" id="status" class="w-full border rounded p-2" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            @error('status')<small class="text-red-600">{{ $message }}</small>@enderror
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
