@extends('layouts.app')

@section('content')
    <h2 class="fw-bold mb-4">Tambah Penghuni Kos</h2>

    <form action="{{ route('kos.store') }}" method="POST">
        @csrf

        @include('kos._form', ['kos' => null])

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('kos.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
