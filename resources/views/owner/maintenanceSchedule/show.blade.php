@extends('layouts.index')

@section('header', 'Detail Pemeliharaan')

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

    <div class="mb-4 flex">
        <a href="{{ route('jadwalPemeliharaan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded inline-flex items-center mr-2">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-yellow-50">
            <h2 class="text-lg font-semibold text-yellow-800">Detail Pemeliharaan</h2>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Kamar</p>
                    <p class="font-medium text-gray-800">{{ $pemeliharaan->kamar->nama_kamar ?? 'Kamar #'.$pemeliharaan->kamar_id }}</p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600 mb-1">Status</p>
                    <p class="font-medium">
                        <span class="inline-block px-3 py-1 {{ $pemeliharaan->status == 'sedang-proses' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }} rounded-full">
                            {{ $pemeliharaan->status == 'sedang-proses' ? 'Sedang Proses' : 'Selesai' }}
                        </span>
                    </p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600 mb-1">Jadwal</p>
                    <p class="font-medium text-gray-800">
                        @if($pemeliharaan->jadwal)
                            {{ Carbon\Carbon::parse($pemeliharaan->jadwal)->format('d M Y H:i') }}
                        @else
                            Belum dijadwalkan
                        @endif
                    </p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600 mb-1">Terakhir Diupdate</p>
                    <p class="font-medium text-gray-800">{{ Carbon\Carbon::parse($pemeliharaan->updated_at)->format('d M Y H:i') }}</p>
                </div>
                
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600 mb-1">Keterangan</p>
                    <p class="font-medium text-gray-800 whitespace-pre-line">{{ $pemeliharaan->keterangan }}</p>
                </div>
            </div>
            
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('jadwalPemeliharaan.edit', $pemeliharaan->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    Edit
                </a>
                
                <form action="{{ route('jadwalPemeliharaan.destroy', $pemeliharaan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal pemeliharaan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function closeNotification() {
            document.getElementById('notification').style.display = 'none';
        }
        
        // Auto-dismiss notification after 5 seconds
        setTimeout(function() {
            var notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 5000);
    </script>
@endsection