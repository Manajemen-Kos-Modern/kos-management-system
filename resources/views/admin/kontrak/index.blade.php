@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Manajemen Kontrak</h1>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse text-sm">
            <thead class="bg-orange-100 text-gray-800 font-semibold">
                <tr>
                    <th class="border px-4 py-2 text-left">ID</th>
                    <th class="border px-4 py-2 text-left">Nama Penyewa</th>
                    <th class="border px-4 py-2 text-left">Kode Kamar</th>
                    <th class="border px-4 py-2 text-left">Tanggal Mulai</th>
                    <th class="border px-4 py-2 text-left">Tanggal Selesai</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kontraks as $kontrak)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $kontrak->id }}</td>
                        <td class="border px-4 py-2">{{ $kontrak->user->nama ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $kontrak->kamar->nomor_kamar ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $kontrak->tanggal_mulai }}</td>
                        <td class="border px-4 py-2">{{ $kontrak->tanggal_selesai }}</td>
                        <td class="border px-4 py-2">
                            <span class="px-2 py-1 rounded text-white
                                {{ $kontrak->status == 'aktif' ? 'bg-green-500' : 'bg-gray-500' }}">
                                {{ ucfirst($kontrak->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border px-4 py-3 text-center text-gray-500">
                            Belum ada data kontrak.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
