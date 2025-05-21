@extends('layouts.index')

@section('header', 'Konfirmasi Hapus Jadwal Pemeliharaan')

@section('content')
    <div class="mb-4">
        <a href="{{ route('jadwalPemeliharaan.show', $pemeliharaan->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-red-50">
            <h2 class="text-lg font-semibold text-red-800">Konfirmasi Hapus</h2>
        </div>
        
        <div class="p-6">
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Peringatan!</p>
                <p>Anda akan menghapus jadwal pemeliharaan ini secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            
            <div class="mb-6">
                <h3 class="text-md font-medium text-gray-700 mb-3">Detail Pemeliharaan:</h3>
                <div class="bg-gray-50 p-4 rounded-md">
                    <p><span class="font-medium">Kamar:</span> {{ $pemeliharaan->kamar->nama_kamar ?? 'Kamar #'.$pemeliharaan->kamar_id }}</p>
                    <p><span class="font-medium">Status:</span> {{ $pemeliharaan->status == 'sedang-proses' ? 'Sedang Proses' : 'Selesai' }}</p>
                    <p><span class="font-medium">Keterangan:</span> {{ Str::limit($pemeliharaan->keterangan, 100) }}</p>
                    <p><span class="font-medium">Dibuat pada:</span> {{ Carbon\Carbon::parse($pemeliharaan->created_at)->format('d M Y H:i') }}</p>
                </div>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('jadwalPemeliharaan.show', $pemeliharaan->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Batal
                </a>
                
                <form action="{{ route('jadwalPemeliharaan.destroy', $pemeliharaan->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        Ya, Hapus Jadwal Pemeliharaan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection