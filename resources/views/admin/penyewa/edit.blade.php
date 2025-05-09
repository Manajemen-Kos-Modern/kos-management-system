@extends('layouts.app')

@section('content')
    <h2 class="fw-bold mb-4">Edit Penghuni Kos</h2>

    <form action="{{ route('kos.update', $kos->id) }}" method="POST">
        @csrf @method('PUT')

        @include('kos._form', ['kos' => $kos])

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('kos.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
