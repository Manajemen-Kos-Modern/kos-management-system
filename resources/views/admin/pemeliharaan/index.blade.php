@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-700">Daftar Pemeliharaan</h3>
            <a href="{{ route('admin.pemeliharaan.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 rounded shadow text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Pemeliharaan
            </a>
        </div>

        <div class="p-6">
            @if(session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 border border-green-300 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border border-gray-200">
                    <thead class="bg-blue-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Kamar</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Keterangan</th>
                            <th class="px-4 py-2 border">Tanggal</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemeliharaans as $pemeliharaan)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border text-center">{{ $pemeliharaan->kamar->nomor_kamar ?? '-' }}</td>
                                <td class="px-4 py-2 border text-center">{{ ucfirst(str_replace('-', ' ', $pemeliharaan->status)) }}</td>
                                <td class="px-4 py-2 border">{{ $pemeliharaan->keterangan }}</td>
                                <td class="px-4 py-2 border text-center">{{ $pemeliharaan->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-2 border text-center space-x-1">
                                    <a href="{{ route('admin.pemeliharaan.edit', $pemeliharaan->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded text-xs">Edit</a>
                                    <form action="{{ route('admin.pemeliharaan.destroy', $pemeliharaan->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center px-4 py-3 text-gray-500">Belum ada data pemeliharaan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
