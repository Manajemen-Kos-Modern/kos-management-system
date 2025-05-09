@extends('layouts.app')

@section('title', 'Detail Kamar')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded-3">
        <div class="card-header bg-primary text-white">
            <h4>Detail Kamar</h4>
        </div>
        <div class="card-body">
            <p><strong>Nomor Kamar:</strong> {{ $kamar->nomor_kamar }}</p>
            <p><strong>Tipe Kamar:</strong> {{ $kamar->tipe_kamar }}</p>
            <p><strong>Harga per malam:</strong> Rp {{ number_format($kamar->harga, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $kamar->status)) }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.kamar.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('admin.kamar.edit', $kamar->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
