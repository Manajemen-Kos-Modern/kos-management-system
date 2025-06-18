@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Keluhan</h2>
        <a href="{{ route('admin.keluhan.create') }}" class="inline-block px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">
            + Tambah Keluhan
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr class="text-left text-sm font-semibold text-gray-700">
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama Pengguna</th>
                    <th class="px-4 py-3">Kamar</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Jenis Keluhan</th>
                    <th class="px-4 py-3">Tanggal Dibuat</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @forelse ($keluhans as $i => $keluhan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $i + 1 }}</td>
                        <td class="px-4 py-3">{{ $keluhan->user->nama ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $keluhan->kamar->nomor_kamar ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $keluhan->keterangan }}</td>
                        <td class="px-4 py-3 capitalize">{{ $keluhan->status }}</td>
                        <td class="px-4 py-3">{{ $keluhan->jenis_keluhan }}</td>
                        <td class="px-4 py-3">{{ $keluhan->created_at->format('d M Y H:i') }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('admin.keluhan.edit', $keluhan->id) }}" class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs">Edit</a>
                            <form action="{{ route('admin.keluhan.destroy', $keluhan->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs" onclick="return confirm('Yakin ingin menghapus keluhan ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center px-4 py-4 text-gray-500">Tidak ada keluhan ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
