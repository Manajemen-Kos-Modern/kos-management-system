@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Daftar Notifikasi</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('admin.notifikasi.create') }}"
               class="inline-block bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition">
                + Buat Notifikasi Baru
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">ID</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">User</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Pesan</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Status</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Waktu Kirim</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($notifikasis as $notif)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-gray-800">{{ $notif->id }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $notif->user_id ?? 'Semua User' }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $notif->pesan }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $notif->status }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $notif->waktu_kirim }}</td>
                            <td class="px-4 py-2 text-gray-800 flex items-center space-x-2">
                                <a href="{{ route('admin.notifikasi.edit', $notif->id) }}"
                                   class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.notifikasi.destroy', $notif->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada notifikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $notifikasis->onEachSide(1)->links('pagination::tailwind') }}

        </div>
    </div>
@endsection
