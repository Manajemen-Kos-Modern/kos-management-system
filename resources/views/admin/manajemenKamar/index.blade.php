@extends('layouts.index')

@section('header', 'Room Management')

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
        <button id="addRoomBtn" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg">
            ADD ROOM
        </button>
    </div>

    <!-- Rooms Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-yellow-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">ROOM</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">PRICE/MONTH
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">STATUS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">OCCUPANT
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-orange-500 uppercase tracking-wider">ACTION
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($kamars as $kamar)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $kamar->nomor_kamar }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">IDR {{ number_format($kamar->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap uppercase">
                            {{ $kamar->status == 'terisi' ? 'TERISI' : 'KOSONG' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $kamar->user->first_name ?? '-' }} {{ $kamar->user->last_name ?? '' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                            <div class="flex justify-end space-x-2">
                                <button class="editRoomBtn bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded"
                                    data-id="{{ $kamar->id }}" 
                                    data-nomor="{{ $kamar->nomor_kamar }}"
                                    data-harga="{{ $kamar->harga }}" 
                                    data-status="{{ $kamar->status }}"
                                    data-deskripsi="{{ $kamar->tipe_kamar }}"
                                    data-gambar="{{ $kamar->gambar_kamar ?? '' }}"
                                    data-penghuni="{{ $kamar->user->first_name ?? '-' }} {{ $kamar->user->last_name ?? '' }}">
                                    Edit
                                </button>
                                <button class="deleteRoomBtn bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded"
                                    data-id="{{ $kamar->id }}">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No room data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-between items-center">
        <div>Showing 1 - {{ $kamars->count() }} of {{ $kamars->total() }}</div>
        <div class="flex space-x-2">
            {{ $kamars->links() }}
        </div>
    </div>

    <!-- Add Room Modal -->
    <div id="addRoomModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-yellow-50 p-6 rounded-lg w-1/3 max-h-[90vh] overflow-y-auto">
            <h2 class="text-lg font-bold text-orange-500 mb-4 text-center">Create New Room</h2>

            <form id="addRoomForm" action="{{ route('manajemenKamar.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <!-- Room Number -->
                <div class="mb-4">
                    <label for="nomor_kamar" class="block text-sm font-medium text-gray-700 mb-1">Room Name</label>
                    <input type="text" name="nomor_kamar" id="nomor_kamar" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                    <input type="number" name="harga" id="harga" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        placeholder="0" min="0">
                </div>

                <!-- Room Description -->
                <div class="mb-4">
                    <label for="tipe_kamar" class="block text-sm font-medium text-gray-700 mb-1">Room Description</label>
                    <textarea name="tipe_kamar" id="tipe_kamar" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        placeholder="Write Room Description"></textarea>
                </div>

                <!-- Room Image -->
                <div class="mb-6">
                    <label for="gambar_kamar" class="block text-sm font-medium text-gray-700 mb-1">Room Image</label>
                    <input type="file" name="gambar_kamar" id="gambar_kamar" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <p class="text-xs text-gray-500 mt-1">Format File: .jpg/.png</p>
                </div>

                <!-- Action Buttons -->
                <div class="text-center">
                    <button type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-6 rounded-md">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Room Modal -->
    <div id="editRoomModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-yellow-50 p-6 rounded-lg w-1/3 max-h-[90vh] overflow-y-auto">
            <h2 class="text-lg font-bold text-orange-500 mb-4 text-center">Edit Room</h2>

            <form id="editRoomForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Room Number -->
                <div class="mb-4">
                    <label for="edit_nomor_kamar" class="block text-sm font-medium text-gray-700 mb-1">Room Name</label>
                    <input type="text" name="nomor_kamar" id="edit_nomor_kamar"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="edit_harga" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                    <input type="number" name="harga" id="edit_harga" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        placeholder="0" min="0">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="edit_status" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option value="belum_terisi" {{ $kamar->status === 'belum_terisi' ? 'selected' : '' }}>KOSONG</option>
                        <option value="terisi" {{ $kamar->status === 'terisi' ? 'selected' : '' }}>TERISI</option>
                    </select>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-600">
                        Penghuni: <span id="namaPenghuni">-</span>
                    </p>
                </div>

                <!-- Room Description -->
                <div class="mb-4">
                    <label for="edit_tipe_kamar" class="block text-sm font-medium text-gray-700 mb-1">Room
                        Description</label>
                    <textarea name="tipe_kamar" id="edit_tipe_kamar" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        placeholder="Write Room Description"></textarea>
                </div>

                <!-- Room Image -->
                <div class="mb-6">
                    <label for="edit_gambar_kamar" class="block text-sm font-medium text-gray-700 mb-1">Room Image</label>
                    <input type="file" name="gambar_kamar" id="edit_gambar_kamar" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <p class="text-xs text-gray-500 mt-1">Format File: .jpg/.png</p>

                    <div id="current_image_container" class="mt-2 hidden">
                        <p class="text-sm text-gray-600">Current Image:</p>
                        <img id="current_image" src="" alt="Current Room Image"
                            class="mt-1 h-24 object-cover rounded">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="text-center">
                    <button type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-6 rounded-md">
                        Edit
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
                <form id="deleteRoomForm" method="POST">
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
            // Add Room Modal
            const addRoomBtn = document.getElementById('addRoomBtn');
            const addRoomModal = document.getElementById('addRoomModal');

            addRoomBtn.addEventListener('click', function() {
                addRoomModal.classList.remove('hidden');
                addRoomModal.classList.add('flex');
            });

            // Close Add Modal when clicking outside
            addRoomModal.addEventListener('click', function(e) {
                if (e.target === addRoomModal) {
                    addRoomModal.classList.add('hidden');
                    addRoomModal.classList.remove('flex');
                }
            });

            // Edit Room Modal
            const editBtns = document.querySelectorAll('.editRoomBtn');
            const editRoomModal = document.getElementById('editRoomModal');
            const editRoomForm = document.getElementById('editRoomForm');

            editBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const nomor = this.getAttribute('data-nomor');
                    const harga = this.getAttribute('data-harga');
                    const status = this.getAttribute('data-status');
                    const deskripsi = this.getAttribute('data-deskripsi');
                    const gambar = this.getAttribute('data-gambar');
                    const penghuni = this.getAttribute('data-penghuni');

                    // Set form action
                    editRoomForm.action = `{{ route('manajemenKamar.update', ':id') }}`.replace(':id', id);

                    // Fill form fields
                    document.getElementById('edit_nomor_kamar').value = nomor;
                    document.getElementById('edit_harga').value = harga;
                    document.getElementById('edit_status').value = status;
                    document.getElementById('edit_tipe_kamar').value = deskripsi;

                    // Tampilkan nama penghuni
                    const namaPenghuniElement = document.getElementById('namaPenghuni');
                    namaPenghuniElement.textContent = (status === 'terisi') ? penghuni : '-';

                    const statusSelect = document.getElementById('edit_status');
                    statusSelect.value = status;
                    
                    // Nonaktifkan input nomor kamar jika status terisi
                    const nomorKamarInput = document.getElementById('edit_nomor_kamar');
                    nomorKamarInput.readOnly = (status === 'terisi');

                    // Handle image preview
                    const currentImageContainer = document.getElementById('current_image_container');
                    const currentImage = document.getElementById('current_image');

                    if (gambar && gambar !== '') {
                        currentImageContainer.classList.remove('hidden');
                        currentImage.src = `/storage/${gambar}`;
                    } else {
                        currentImageContainer.classList.add('hidden');
                    }

                    // Show modal
                    editRoomModal.classList.remove('hidden');
                    editRoomModal.classList.add('flex');
                });
            });

            // Close Edit Modal when clicking outside
            editRoomModal.addEventListener('click', function(e) {
                if (e.target === editRoomModal) {
                    editRoomModal.classList.add('hidden');
                    editRoomModal.classList.remove('flex');
                }
            });

            // Delete Room Modal
            const deleteBtns = document.querySelectorAll('.deleteRoomBtn');
            const deleteConfirmModal = document.getElementById('deleteConfirmModal');
            const deleteRoomForm = document.getElementById('deleteRoomForm');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');

                    // Set form action
                    deleteRoomForm.action = `{{ route('manajemenKamar.index') }}/${id}`;

                    // Show modal
                    deleteConfirmModal.classList.remove('hidden');
                    deleteConfirmModal.classList.add('flex');
                });
            });

            // Cancel delete
            cancelDeleteBtn.addEventListener('click', function() {
                deleteConfirmModal.classList.add('hidden');
                deleteConfirmModal.classList.remove('flex');
            });

            // Close Delete Modal when clicking outside
            deleteConfirmModal.addEventListener('click', function(e) {
                if (e.target === deleteConfirmModal) {
                    deleteConfirmModal.classList.add('hidden');
                    deleteConfirmModal.classList.remove('flex');
                }
            });

            // Search functionality
            const searchInput = document.getElementById('search');
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    const searchValue = this.value.trim();

                    if (searchValue !== '') {
                        window.location.href = `{{ route('manajemenKamar.index') }}?search=${searchValue}`;
                    } else {
                        window.location.href = '{{ route('manajemenKamar.index') }}';
                    }
                }
            });
        });
    </script>
@endsection
