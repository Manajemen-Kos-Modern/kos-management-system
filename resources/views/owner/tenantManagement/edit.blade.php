@extends('layouts.index')

@section('header', 'Edit Occupant')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold text-orange-500 mb-4">Edit Occupant</h2>

        <form action="{{ route('manajemenPenyewa.update', $penyewa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $penyewa->name) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" required value="{{ old('email', $penyewa->email) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Room Selection -->
            <div class="mb-4">
                <label for="room_id" class="block text-sm font-medium text-gray-700 mb-1">Room</label>
                <select name="room_id" id="room_id" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <option value="">Select Room</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ (old('room_id', $penyewa->room_id) == $room->id) ? 'selected' : '' }}>
                            {{ $room->nomor_kamar }}
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ends On -->
            <div class="mb-4">
                <label for="ends_on" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                <input type="date" name="ends_on" id="ends_on" required 
                       value="{{ old('ends_on', $penyewa->ends_on ? $penyewa->ends_on->format('Y-m-d') : '-') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                @error('ends_on')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <option value="active" {{ old('status', $penyewa->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="in_arrangement" {{ old('status', $penyewa->status) == 'in_arrangement' ? 'selected' : '' }}>In Arrangement</option>
                    <option value="not_active" {{ old('status', $penyewa->status) == 'not_active' ? 'selected' : '' }}>Not Active</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Payment Status -->
            <div class="mb-6">
                <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                <select name="payment_status" id="payment_status" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <option value="paid" {{ old('payment_status', $penyewa->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="unpaid" {{ old('payment_status', $penyewa->payment_status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="in_arrangement" {{ old('payment_status', $penyewa->payment_status) == 'in_arrangement' ? 'selected' : '' }}>In Arrangement</option>
                </select>
                @error('payment_status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between">
                <a href="{{ route('manajemenPenyewa.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-6 rounded-md">
                    Cancel
                </a>
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-6 rounded-md">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection