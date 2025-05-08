@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">Daftar Penghuni Kos</h2>
        <a href="{{ route('kos.create') }}" class="btn btn-primary mt-2">+ Tambah Penghuni</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Jenis Kelamin</th>
                    <th>Kode Kamar</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i => $row)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->no_hp }}</td>
                        <td>{{ $row->jenis_kelamin }}</td>
                        <td>{{ $row->kode_kamar }}</td>
                        <td>Rp{{ number_format($row->harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $row->status == 'Masuk' ? 'success' : 'secondary' }}">
                                {{ $row->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('kos.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('kos.destroy', $row->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
