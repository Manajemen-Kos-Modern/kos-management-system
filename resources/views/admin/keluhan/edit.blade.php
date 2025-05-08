<!-- resources/views/keluhan/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Keluhan</h2>

    
    <a href="{{ route('admin.keluhan.index') }}">Back to Keluhan</a>


    <form action="{{ route('keluhan.update', $keluhan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Pengguna:</label>
            <input type="text" class="form-control" value="{{ $keluhan->user->name }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Kamar:</label>
            <input type="text" class="form-control" value="{{ $keluhan->kamar_id }}" readonly>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan:</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan', $keluhan->keterangan) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="jenis_keluhan" class="form-label">Jenis Keluhan:</label>
            <select name="jenis_keluhan" class="form-control">
                <option value="Fasilitas" {{ old('jenis_keluhan', $keluhan->jenis_keluhan) == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                <option value="Kebersihan" {{ old('jenis_keluhan', $keluhan->jenis_keluhan) == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                <option value="Keamanan" {{ old('jenis_keluhan', $keluhan->jenis_keluhan) == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                <!-- Tambahkan jika ada jenis lain -->
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select name="status" class="form-control">
    <option value="diterima" {{ $keluhan->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
    <option value="proses" {{ $keluhan->status == 'proses' ? 'selected' : '' }}>Proses</option>
    <option value="selesai" {{ $keluhan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select>

        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

@endsection
