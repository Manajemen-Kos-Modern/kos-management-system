@extends('layouts.index')

@section('header', 'Detail Keluhan')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Keluhan</h3>
                
                <div class="mb-4">
                    <p class="text-gray-600 font-medium">Jenis Keluhan</p>
                    <p class="text-gray-800">{{ $keluhan->jenis_keluhan }}</p>
                </div>
                
                <div class="mb-4">
                    <p class="text-gray-600 font-medium">Status</p>
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
                </div>
                
                <div class="mb-4">
                    <p class="text-gray-600 font-medium">Tanggal Pelaporan</p>
                    <p class="text-gray-800">{{ $keluhan->created_at->format('d M Y, H:i') }}</p>
                </div>
                
                <div class="mb-4">
                    <p class="text-gray-600 font-medium">Tanggal Update</p>
                    <p class="text-gray-800">{{ $keluhan->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pelapor</h3>
                
                <div class="mb-4">
                    <p class="text-gray-600 font-medium">Nama</p>
                    <p class="text-gray-800">{{ $keluhan->user->name }}</p>
                </div>
                
                <div class="mb-4">
                    <p class="text-gray-600 font-medium">Kamar</p>
                    <p class="text-gray-800">{{ optional($keluhan->kamar)->nomor_kamar ?? '-' }}</p>
                </div>
            </div>
        </div>
        
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Keterangan</h3>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-800 whitespace-pre-line">{{ $keluhan->keterangan }}</p>
            </div>
        </div>
        
        <div class="mt-6 flex justify-between">
            <div>
                <a href="{{ route('manajemenKeluhan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg">Kembali</a>
            </div>
            
            <div class="flex space-x-2">
                @if ($keluhan->status === 'diterima')
                <form action="{{ route('manajemenKeluhan.updateStatus', $keluhan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="proses">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg">
                        Proses Keluhan
                    </button>
                </form>
                @elseif ($keluhan->status === 'proses')
                <form action="{{ route('manajemenKeluhan.updateStatus', $keluhan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="selesai">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">
                        Selesaikan Keluhan
                    </button>
                </form>
                @endif
                
                @if ($keluhan->status !== 'selesai')
                <a href="{{ route('manajemenKeluhan.edit', $keluhan->id) }}" 
                   class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-lg">
                    Edit Keluhan
                </a>
                @endif
            </div>
        </div>
    </div>
@endsection