@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Daftar Pembayaran</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 text-sm">
            <thead class="bg-blue-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border">User</th>
                    <th class="px-4 py-2 border">Kontrak</th>
                    <th class="px-4 py-2 border">Harga</th>
                    <th class="px-4 py-2 border">Metode</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayarans as $pembayaran)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $pembayaran->user->name }}</td>
                        <td class="px-4 py-2 border">#{{ $pembayaran->kontrak->id }}</td>
                        <td class="px-4 py-2 border">Rp{{ number_format($pembayaran->harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($pembayaran->metode_pembayaran) }}</td>
                        <td class="px-4 py-2 border">
                            @if ($pembayaran->status === 'pending')
                                <span class="bg-yellow-300 text-yellow-900 px-2 py-1 rounded text-xs font-semibold">Pending</span>
                            @elseif ($pembayaran->status === 'sukses')
                                <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-semibold">Sukses</span>
                            @else
                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-semibold">Gagal</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border space-x-1">
                            @if ($pembayaran->status === 'pending')
                                <form action="{{ route('admin.pembayarans.konfirmasi', $pembayaran->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-xs">Konfirmasi</button>
                                </form>
                                <form action="{{ route('admin.pembayarans.tolak', $pembayaran->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Tolak</button>
                                </form>
                                <form action="{{ route('admin.pembayarans.verify', $pembayaran->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Verify</button>
                                </form>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center text-gray-500">Belum ada data pembayaran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
