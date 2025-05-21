@extends('layouts.index')

@section('header', 'Delete Room')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
        <h2 class="text-lg font-bold text-red-500 mb-4 text-center">Confirm Delete Room</h2>
        
        <div class="mb-6">
            <p class="text-center text-gray-700">Are you sure you want to delete room <strong>{{ $kamar->nomor_kamar }}</strong>?</p>
            <p class="text-center text-gray-500 text-sm mt-2">This action cannot be undone.</p>
        </div>
        
        <div class="flex justify-center space-x-4">
            <a href="{{ route('manajemenKamar.index') }}" 
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-6 rounded-md">
                Cancel
            </a>
            
            <form action="{{ route('manajemenKamar.destroy', $kamar->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-md">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endsection