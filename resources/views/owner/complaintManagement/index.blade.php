@extends('layouts.index')

@section('header', 'Manajemen Keluhan')

@section('content')
    <!-- Flash Message with Auto-dismiss and close button -->
    @if (session('success') || session('error'))
        <div id="notification" class="{{ session('success') ? 'bg-green-100 border-l-4 border-green-500 text-green-700' : 'bg-red-100 border-l-4 border-red-500 text-red-700' }} p-4 mb-6 rounded relative" role="alert">
            <span>{{ session('success') ?? session('error') }}</span>
            <button type="button" class="absolute top-0 right-0 mt-3 mr-3" onclick="closeNotification()">
                <svg class="h-4 w-4 text-gray-500 hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Search and Add Button -->
    <div class="flex justify-between items-center mb-6">
        <div class="relative">
            <input type="text" id="search" placeholder="Cari..."
                class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
        <a href="{{ route('manajemenKeluhan.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg">
            Tambah Keluhan
        </a>
    </div>

    <!-- Keluhan Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-yellow-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">NAMA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">KAMAR</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">KETERANGAN</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">STATUS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">JENIS KELUHAN</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-orange-500 uppercase tracking-wider">AKSI</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($keluhans as $keluhan)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $keluhan->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ optional($keluhan->kamar)->nomor_kamar ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($keluhan->keterangan, 50) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded-full 
                                @if ($keluhan->status === 'diterima')
                                    bg-blue-100 text-blue-800
                                @elseif ($keluhan->status === 'proses')
                                    bg-orange-100 text-orange-800
                                @elseif ($keluhan->status === 'selesai')
                                    bg-green-100 text-green-800
                                @else
                                    bg-gray-100 text-gray-800
                                @endif">
                                {{ $keluhan->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $keluhan->jenis_keluhan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('manajemenKeluhan.show', $keluhan->id) }}" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded">
                                    Detail
                                </a>
                                
                                @if ($keluhan->status === 'diterima')
                                <form action="{{ route('manajemenKeluhan.updateStatus', $keluhan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="proses">
                                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">
                                        Proses
                                    </button>
                                </form>
                                @elseif ($keluhan->status === 'proses')
                                <form action="{{ route('manajemenKeluhan.updateStatus', $keluhan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="selesai">
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded">
                                        Selesai
                                    </button>
                                </form>
                                @endif
                                
                                @if ($keluhan->status !== 'selesai')
                                <a href="{{ route('manajemenKeluhan.edit', $keluhan->id) }}" 
                                   class="bg-orange-500 hover:bg-orange-600 text-white py-1 px-3 rounded">
                                    Edit
                                </a>
                                @endif
                                
                                <form action="{{ route('manajemenKeluhan.destroy', $keluhan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus keluhan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data keluhan tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-between items-center">
        <div>Tampilan {{ $keluhans->firstItem() ?? 0 }} - {{ $keluhans->lastItem() ?? 0 }} of {{ $keluhans->total() }}</div>
        <div class="flex space-x-2">
            {{ $keluhans->links() }}
        </div>
    </div>

    <!-- Script untuk menutup notifikasi -->
    <script>
        // Fungsi untuk menutup notifikasi dengan tombol X
        function closeNotification() {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }

        // Auto dismiss setelah 5 detik (5000ms)
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('notification');
            if (notification) {
                setTimeout(function() {
                    notification.style.opacity = '1';
                    let fadeEffect = setInterval(function() {
                        if (notification.style.opacity > 0) {
                            notification.style.opacity -= 0.1;
                        } else {
                            clearInterval(fadeEffect);
                            notification.style.display = 'none';
                        }
                    }, 100);
                }, 5000);
            }

            // Search functionality
            const searchInput = document.getElementById('search');
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    const searchValue = this.value.trim();
                    if (searchValue !== '') {
                        window.location.href = `{{ route('manajemenKeluhan.index') }}?search=${searchValue}`;
                    } else {
                        window.location.href = '{{ route('manajemenKeluhan.index') }}';
                    }
                }
            });
        });
    </script>
@endsection