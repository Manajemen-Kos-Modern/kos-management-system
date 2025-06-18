@extends('layouts.app')

@section('title', 'Manajemen Kamar')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Daftar Kamar</h1>
            <a href="{{ route('admin.kamar.create') }}"
               class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded shadow">
                + Tambah Kamar
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">No</th>
                        <th class="px-4 py-2 text-left">Nomor Kamar</th>
                        <th class="px-4 py-2 text-left">Tipe Kamar</th>
                        <th class="px-4 py-2 text-left">Harga</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @forelse ($kamars as $index => $kamar)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $kamar->nomor_kamar }}</td>
                            <td class="px-4 py-2">{{ $kamar->tipe_kamar }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ ucfirst(str_replace('_', ' ', $kamar->status)) }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('admin.kamar.edit', $kamar->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.kamar.destroy', $kamar->id) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Yakin ingin hapus kamar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-400 hover:bg-red-500 text-white px-3 py-1 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                Belum ada data kamar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
