@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Pemeliharaan</h3>
            <div class="card-tools">
                <a href="{{ route('admin.pemeliharaan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kamar</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pemeliharaans as $pemeliharaan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pemeliharaan->kamar->nomor_kamar ?? '-' }}</td>
                <td>{{ ucfirst(str_replace('-', ' ', $pemeliharaan->status)) }}</td>
                <td>{{ $pemeliharaan->keterangan }}</td>
                <td>{{ $pemeliharaan->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.pemeliharaan.edit', $pemeliharaan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.pemeliharaan.destroy', $pemeliharaan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data pemeliharaan</td>
            </tr>
        @endforelse
    </tbody>
</table>

        </div>
    </div>
</div>
@endsection