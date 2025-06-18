@extends('layouts.app')

@section('title', 'Tambah Data Kamar')

@section('content')
    <div class="container mx-auto">
        <div class="max-w-xl bg-white p-6 rounded shadow mx-auto">
            <h1 class="text-2xl font-semibold mb-4 text-gray-800">Tambah Data Kamar</h1>

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.kamar.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="nomor_kamar" class="block text-gray-700 font-medium">Nomor Kamar</label>
                    <input type="text" id="nomor_kamar" name="nomor_kamar" required
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-orange-500">
                </div>

                <div>
                    <label for="tipe_kamar" class="block text-gray-700 font-medium">Tipe Kamar</label>
                    <input type="text" id="tipe_kamar" name="tipe_kamar" required
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-orange-500">
                </div>

                <div>
                    <label for="harga" class="block text-gray-700 font-medium">Harga</label>
                    <input type="number" id="harga" name="harga" required
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-orange-500">
                </div>

                <div>
                    <label for="status" class="block text-gray-700 font-medium">Status</label>
                    <select id="status" name="status" required
                        class="w-full mt-1 px-4 py-2 border rounded-lg bg-white focus:outline-none focus:ring focus:border-orange-500">
                        <option value="belum_terisi">Belum Terisi</option>
                        <option value="terisi">Terisi</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    <a href="{{ route('admin.kamar.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded shadow">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded shadow">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
