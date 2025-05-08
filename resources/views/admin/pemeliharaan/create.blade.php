@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pemeliharaan Kamar</h2>

    <form action="{{ route('pemeliharaan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nomor Kamar</label>
            <select name="kamar_id" class="form-control" required>
                @foreach($kamars as $kamar)
                    <option value="{{ $kamar->id }}">{{ $kamar->nomor }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
