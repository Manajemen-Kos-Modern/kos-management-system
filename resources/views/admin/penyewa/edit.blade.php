@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Edit Penghuni Kos</h2>

    <form action="{{ route('admin.penyewa.update', $penyewa->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        @include('admin.penyewa._form', ['penyewa' => $penyewa])

        <div class="flex justify-end space-x-2 pt-4">
            <a href="{{ route('admin.penyewa.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
               Batal
            </a>
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
