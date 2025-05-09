<!-- resources/views/admin/keluhan/index.blade.php -->

@extends('layouts.app') <!-- Pastikan layout yang sesuai -->

@section('content')
<div class="container">
    <h1>Daftar Keluhan</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Kamar</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Jenis Keluhan</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($keluhans as $keluhan)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $keluhan->user->first_name }} {{ $keluhan->user->last_name }}</td>
            <td>{{ $keluhan->kamar->nomor_kamar }}</td>

            <td>{{ $keluhan->keterangan }}</td>
            <td>{{ $keluhan->status }}</td>
            <td>{{ $keluhan->jenis_keluhan }}</td>
            <td>{{ $keluhan->created_at->format('d M Y H:i') }}</td>

                <td>
                    <a href="{{ route('admin.keluhan.edit', $keluhan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.keluhan.destroy', $keluhan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
