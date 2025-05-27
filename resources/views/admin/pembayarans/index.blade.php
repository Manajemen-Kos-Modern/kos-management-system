@extends('layouts.app')

@section('content')
<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-primary">
            <tr>
                <th>User</th>
                <th>Kontrak</th>
                <th>Harga</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembayarans as $pembayaran)
                <tr>
                    <td>{{ $pembayaran->user->name }}</td>
                    <td>{{ $pembayaran->kontrak->id }}</td>
                    <td>Rp{{ number_format($pembayaran->harga, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($pembayaran->metode_pembayaran) }}</td>
                    <td>
                        @if ($pembayaran->status === 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif ($pembayaran->status === 'sukses')
                            <span class="badge bg-success">Sukses</span>
                        @else
                            <span class="badge bg-danger">Gagal</span>
                        @endif
                    </td>
                    <td>
                        @if ($pembayaran->status === 'pending')
                            <form action="{{ route('admin.pembayarans.konfirmasi', $pembayaran->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success me-1">Konfirmasi</button>
                            </form>
                            <form action="{{ route('admin.pembayarans.tolak', $pembayaran->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger me-1">Tolak</button>
                            </form>
                            <form action="{{ route('admin.pembayarans.verify', $pembayaran->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-info">Verify</button>
                            </form>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
