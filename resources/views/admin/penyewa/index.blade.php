@extends('layouts.app')

@section('title', 'Manajemen Penyewa')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Pengguna</h2>
        <a href="{{ route('admin.penyewa.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
            + Tambah Pengguna
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Foto</th>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">No HP</th>
                    <th class="px-4 py-2 text-left">Jenis Kelamin</th>
                    <th class="px-4 py-2 text-left">Role</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($penyewas as $i => $user)
                    <tr>
                        <td class="px-4 py-2">{{ $i + 1 }}</td>
                        <td class="px-4 py-2">
                            <img src="{{ $user->foto_profile ? asset('storage/' . $user->foto_profile) : asset('images/default-profile.png') }}"
                                 alt="Foto" class="w-10 h-10 rounded-full object-cover">
                        </td>
                        <td class="px-4 py-2">{{ $user->nama }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->no_hp }}</td>
                        <td class="px-4 py-2">{{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="px-4 py-2">
                            <span class="inline-block px-2 py-1 text-xs font-medium rounded 
                                {{ $user->role == 'admin' ? 'bg-blue-100 text-blue-700' : 
                                   ($user->role == 'pemilik' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.penyewa.edit', $user->id) }}"
                        class="inline-block bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-sm">
                        Edit
                        </a>

                        <form action="{{ route('admin.penyewa.destroy', $user->id) }}" method="POST" class="inline-block"
                            onsubmit="return confirm('Yakin ingin hapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                                Hapus
                            </button>
                        </form>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
