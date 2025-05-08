@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pemeliharaan</h2>
    <a href="{{ route('pemeliharaan.create') }}" class="btn btn-success mb-3">Tambah Pemeliharaan</a>

    @foreach($data as $item)
        <div class="card mb-2">
            <div class="card-body">
                <strong>Kamar: {{ $item->kamar->nomor ?? 'N/A' }}</strong><br>
                Status: {{ $item->status }}<br>
                Keterangan: {{ $item->keterangan }}<br>
                Tanggal: {{ $item->created_at->format('d M Y H:i') }}

                <form action="{{ route('pemeliharaan.destroy', $item->id) }}" method="POST" class="float-end">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
