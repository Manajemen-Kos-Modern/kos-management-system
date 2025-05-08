@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Data Kamar</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.kamar.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
                <input type="text" class="form-control" id="nomor_kamar" name="nomor_kamar" required>
            </div>

            <div class="mb-3">
                <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
                <input type="text" class="form-control" id="tipe_kamar" name="tipe_kamar" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="belum_terisi">Belum Terisi</option>
                    <option value="terisi">Terisi</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.kamar.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
