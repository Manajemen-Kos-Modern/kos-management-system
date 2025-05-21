<?php

namespace App\Http\Controllers\Owner;
use Illuminate\Support\Facades\Log;
use App\Models\Kamar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User; // Ganti Penyewa menjadi User
use Carbon\Carbon; // Tambahkan import Carbon yang hilang

class TenantManagementController extends Controller
{
    public function index(Request $request) {

        $query = User::where('role', 'pengguna') // Ganti Penyewa menjadi User
                ->with(['kontrak.kamar', 'pembayaran' => function($query) {
                    $query->latest();
                }]);
                
                
        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
                  // Tambahkan kolom pencarian lain jika perlu
            });
        }

        $penyewas = $query->paginate(10);

        $penyewas->getCollection()->transform(function($penyewa) {
        // Inisialisasi status pembayaran
            $status = '-'; 

            // Periksa apakah penyewa memiliki kontrak aktif dan kamar yang disewa
            $kontrak = $penyewa->kontrak;
            $kamar = optional($penyewa->kontrak)->kamar;
            
            if ($kamar) {
                $latestPayment = $penyewa->pembayaran->first();
                if ($latestPayment) {
                    // Status "lunas" jika pembayaran sudah ada dan statusnya "lunas"
                    $status = $latestPayment->status === 'lunas' ? 'lunas' : 'belum lunas';
                } else {
                    // Jika tidak ada pembayaran
                    $status = 'belum lunas';
                }
            }

            // Jika penyewa tidak memesan kamar atau kontraknya sudah selesai
            if (!$kamar || !$kontrak || $kontrak->tanggal_selesai < now()) {
                $status = '-';
            }

            // Menambahkan status ke objek penyewa
            $penyewa->status_pembayaran = $status;

            return $penyewa;
        });
        
        return view ('owner.tenantManagement.index', [
            'title' => 'Manajemen Penyewa',
            'penyewas' => $penyewas, // Data banyak penyewa untuk ditampilkan
        ]);
    }

    public function create()
    {
        // Ambil semua kamar yang belum terisi
        $kamars = Kamar::where('status', 'belum_terisi')->get();
        
        return view('owner.tenantManagement.create', [
            'title' => 'Add New Occupant',
            'kamars' => $kamars
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Ganti tabel penyewas menjadi users
            'room_id' => 'required|exists:kamars,id',
            'ends_on' => 'required|date|after:today',
            'status' => 'required|in:active,in_arrangement,not_active',
            'payment_status' => 'required|in:paid,unpaid,in_arrangement',
        ]);

        // Convert date
        $validated['ends_on'] = Carbon::parse($validated['ends_on']);
        
        // Buat penyewa baru
        $penyewa = User::create($validated); // Ganti Penyewa menjadi User
        
        // Update status kamar menjadi terisi
        $kamar = Kamar::find($validated['room_id']);
        if ($kamar && $validated['status'] === 'active') {
            $kamar->status = 'terisi';
            $kamar->user_id = $penyewa->id;
            $kamar->save();
        }

        return redirect()->route('manajemenPenyewa.index')
            ->with('success', 'Occupant added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $penyewa) // Ganti Penyewa menjadi User
    {
        // Load the room relationship
        $penyewa->load('room');
        
        // Get all rooms (including the currently assigned room)
        $rooms = Kamar::where('status', 'belum_terisi')
                 ->orWhere('id', $penyewa->room_id)
                 ->get();
        
        return view('owner.tenantManagement.edit', [
            'title' => 'Edit Occupant',
            'penyewa' => $penyewa,
            'rooms' => $rooms
        ]);
    }

    /**
     * Show delete confirmation page
     */
    public function delete(User $penyewa) // Ganti Penyewa menjadi User
    {
        // Load the room relationship
        $penyewa->load('room');
        
        return view('owner.tenantManagement.delete', [
            'title' => 'Delete Occupant',
            'penyewa' => $penyewa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $penyewa) // Ganti Penyewa menjadi User
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $penyewa->id, // Ganti tabel penyewas menjadi users
            'room_id' => 'required|exists:kamars,id',
            'ends_on' => 'required|date',
            'status' => 'required|in:active,in_arrangement,not_active',
            'payment_status' => 'required|in:paid,unpaid,in_arrangement',
        ]);

        // Convert date
        $validated['ends_on'] = Carbon::parse($validated['ends_on']);
        
        // Check if room changed
        $roomChanged = $penyewa->room_id != $validated['room_id'];
        $oldRoomId = $penyewa->room_id;
        
        // Update penyewa
        $penyewa->update($validated);
        
        // Handle room status changes
        if ($roomChanged) {
            // Free the old room if exists
            if ($oldRoomId) {
                $oldRoom = Kamar::find($oldRoomId);
                if ($oldRoom) {
                    $oldRoom->status = 'belum_terisi';
                    $oldRoom->user_id = null;
                    $oldRoom->save();
                }
            }
            
            // Assign the new room
            $newRoom = Kamar::find($validated['room_id']);
            if ($newRoom && $validated['status'] === 'active') {
                $newRoom->status = 'terisi';
                $newRoom->user_id = $penyewa->id;
                $newRoom->save();
            }
        } else if ($penyewa->status !== $validated['status']) {
            // Just status changed, update room accordingly
            $room = Kamar::find($penyewa->room_id);
            if ($room) {
                if ($validated['status'] === 'active') {
                    $room->status = 'terisi';
                    $room->user_id = $penyewa->id;
                } else {
                    $room->status = 'belum_terisi';
                    $room->user_id = null;
                }
                $room->save();
            }
        }

        return redirect()->route('manajemenPenyewa.index')
            ->with('success', 'Occupant updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $penyewa) // Ganti Penyewa menjadi User
    {
        try {
            // Free the room if occupied by this tenant
            if ($penyewa->room_id) {
                $room = Kamar::find($penyewa->room_id);
                if ($room) {
                    $room->status = 'belum_terisi';
                    $room->user_id = null;
                    $room->save();
                }
            }
            
            // Delete the tenant
            $penyewa->delete();
            
            return redirect()->route('manajemenPenyewa.index')
                ->with('success', 'Occupant deleted successfully');
        } catch (\Exception $e) {
            // Log error for debugging
            Log::error('Error deleting occupant: ' . $e->getMessage());
            
            return redirect()->route('manajemenPenyewa.index')
                ->with('error', 'Failed to delete occupant: ' . $e->getMessage());
        }
    }
}