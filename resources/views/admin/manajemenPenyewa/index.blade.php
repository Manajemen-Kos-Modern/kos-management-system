@extends('layouts.index')

@section('header', 'Occupant Management')

@section('content')
    <!-- Flash Message -->
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search and Add Button -->
    <div class="flex justify-between items-center mb-6">
        <div class="relative">
            <input type="text" id="search" placeholder="Search..."
                class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
        <button id="addOccupantBtn" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg">
            ADD OCCUPANT
        </button>
    </div>

    <!-- Occupants Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-yellow-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">NAME</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">EMAIL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">ROOM</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">ENDS ON</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">STATUS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">PAYMENT STATUS</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-orange-500 uppercase tracking-wider">ACTION</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($penyewas as $penyewa)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $penyewa->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $penyewa->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $penyewa->room->nomor_kamar ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $penyewa->ends_on->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap uppercase">
                            <span class="px-2 py-1 rounded-full {{ $penyewa->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $penyewa->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap uppercase">
                            <span class="px-2 py-1 rounded-full {{ $penyewa->payment_status === 'paid' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' }}">
                                {{ $penyewa->payment_status ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                            <div class="flex justify-end space-x-2">
                                <button class="editOccupantBtn bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded"
                                    data-id="{{ $penyewa->id }}"
                                    data-name="{{ $penyewa->name }}"
                                    data-email="{{ $penyewa->email }}"
                                    data-room="{{ $penyewa->room_id }}"
                                    data-ends-on="{{ $penyewa->ends_on->format('Y-m-d') }}"
                                    data-status="{{ $penyewa->status }}"
                                    data-payment-status="{{ $penyewa->payment_status }}">
                                    Edit
                                </button>
                                <button class="deleteOccupantBtn bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded"
                                    data-id="{{ $penyewa->id }}">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">No occupant data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-between items-center">
        <div>Showing {{ $penyewas->firstItem() }} - {{ $penyewas->lastItem() }} of {{ $penyewas->total() }}</div>
        <div class="flex space-x-2">
            {{ $penyewas->links() }}
        </div>
    </div>

    <!-- Add Occupant Modal -->
    <div id="addOccupantModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-yellow-50 p-6 rounded-lg w-1/3 max-h-[90vh] overflow-y-auto">
            <h2 class="text-lg font-bold text-orange-500 mb-4 text-center">Add New Occupant</h2>
            <form id="addOccupantForm" action="{{ route('manajemenPenyewa.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" id="name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <!-- Room Selection -->
                <div class="mb-4">
                    <label for="room_id" class="block text-sm font-medium text-gray-700 mb-1">Room</label>
                    <select name="room_id" id="room_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->nomor_kamar }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Ends On -->
                <div class="mb-4">
                    <label for="ends_on" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <input type="date" name="ends_on" id="ends_on" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option value="active">Active</option>
                        <option value="in_arrangement">In Arrangement</option>
                        <option value="not_active">Not Active</option>
                    </select>
                </div>

                <!-- Payment Status -->
                <div class="mb-6">
                    <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                    <select name="payment_status" id="payment_status" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                        <option value="in_arrangement">In Arrangement</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="text-center">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-6 rounded-md">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Occupant Modal -->
    <div id="editOccupantModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-yellow-50 p-6 rounded-lg w-1/3 max-h-[90vh] overflow-y-auto">
            <h2 class="text-lg font-bold text-orange-500 mb-4 text-center">Edit Occupant</h2>
            <form id="editOccupantForm" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" id="edit_name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="edit_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="edit_email" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <!-- Room Selection -->
                <div class="mb-4">
                    <label for="edit_room_id" class="block text-sm font-medium text-gray-700 mb-1">Room</label>
                    <select name="room_id" id="edit_room_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->nomor_kamar }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Ends On -->
                <div class="mb-4">
                    <label for="edit_ends_on" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <input type="date" name="ends_on" id="edit_ends_on" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="edit_status" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option value="active">Active</option>
                        <option value="in_arrangement">In Arrangement</option>
                        <option value="not_active">Not Active</option>
                    </select>
                </div>

                <!-- Payment Status -->
                <div class="mb-6">
                    <label for="edit_payment_status" class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                    <select name="payment_status" id="edit_payment_status" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                        <option value="in_arrangement">In Arrangement</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="text-center">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-6 rounded-md">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-yellow-50 p-6 rounded-lg">
            <h2 class="text-lg font-bold text-center mb-4">Confirm Delete?</h2>
            <div class="flex justify-center space-x-4">
                <button id="cancelDeleteBtn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-6 rounded-md">
                    Cancel
                </button>
                <form id="deleteOccupantForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-md">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add Occupant Modal
            const addOccupantBtn = document.getElementById('addOccupantBtn');
            const addOccupantModal = document.getElementById('addOccupantModal');

            addOccupantBtn.addEventListener('click', function() {
                addOccupantModal.classList.remove('hidden');
                addOccupantModal.classList.add('flex');
            });

            // Close Add Modal
            addOccupantModal.addEventListener('click', function(e) {
                if (e.target === addOccupantModal) {
                    addOccupantModal.classList.add('hidden');
                    addOccupantModal.classList.remove('flex');
                }
            });

            // Edit Occupant Modal
            const editBtns = document.querySelectorAll('.editOccupantBtn');
            const editOccupantModal = document.getElementById('editOccupantModal');
            const editOccupantForm = document.getElementById('editOccupantForm');

            editBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const formAction = `{{ route('manajemenPenyewa.index') }}/${id}`;
                    
                    // Isi form dengan data dari atribut data
                    document.getElementById('edit_name').value = this.getAttribute('data-name');
                    document.getElementById('edit_email').value = this.getAttribute('data-email');
                    document.getElementById('edit_room_id').value = this.getAttribute('data-room');
                    document.getElementById('edit_ends_on').value = this.getAttribute('data-ends-on');
                    document.getElementById('edit_status').value = this.getAttribute('data-status');
                    document.getElementById('edit_payment_status').value = this.getAttribute('data-payment-status');

                    // Set form action
                    editOccupantForm.action = formAction;

                    // Tampilkan modal
                    editOccupantModal.classList.remove('hidden');
                    editOccupantModal.classList.add('flex');
                });
            });

            // Close Edit Modal
            editOccupantModal.addEventListener('click', function(e) {
                if (e.target === editOccupantModal) {
                    editOccupantModal.classList.add('hidden');
                    editOccupantModal.classList.remove('flex');
                }
            });

            // Delete Occupant Modal
            const deleteBtns = document.querySelectorAll('.deleteOccupantBtn');
            const deleteConfirmModal = document.getElementById('deleteConfirmModal');
            const deleteOccupantForm = document.getElementById('deleteOccupantForm');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    deleteOccupantForm.action = `{{ route('manajemenPenyewa.index') }}/${id}`;
                    deleteConfirmModal.classList.remove('hidden');
                    deleteConfirmModal.classList.add('flex');
                });
            });

            // Close Delete Modal
            cancelDeleteBtn.addEventListener('click', () => deleteConfirmModal.classList.add('hidden'));
            deleteConfirmModal.addEventListener('click', (e) => {
                if (e.target === deleteConfirmModal) deleteConfirmModal.classList.add('hidden');
            });

            // Search Functionality
            document.getElementById('search').addEventListener('keypress', function