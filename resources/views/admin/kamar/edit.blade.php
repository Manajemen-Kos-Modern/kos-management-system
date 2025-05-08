@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Data Kamar</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kamar.update', $kamar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
                <input type="text" class="form-control" id="nomor_kamar" name="nomor_kamar"
                    value="{{ $kamar->nomor_kamar }}" required>
            </div>

            <div class="mb-3">
                <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
                <input type="text" class="form-control" id="tipe_kamar" name="tipe_kamar"
                    value="{{ $kamar->tipe_kamar }}" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ $kamar->harga }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="belum_terisi" {{ $kamar->status == 'belum_terisi' ? 'selected' : '' }}>Belum Terisi
                    </option>
                    <option value="terisi" {{ $kamar->status == 'terisi' ? 'selected' : '' }}>Terisi</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.kamar.index') }}" class="btn btn-secondary">← Kembali</a>
        </form>
    </div>
@endsection
