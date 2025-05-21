<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kamar::with('user');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_kamar', 'like', "%{$search}%")
                  ->orWhere('tipe_kamar', 'like', "%{$search}%");
            });
        }

        $kamars = $query->paginate(10);

        return view('owner.roomManagement.index', [
            'title' => 'Manajemen Kamar',
            'kamars' => $kamars,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owner.roomManagement.create', [
            'title' => 'Tambah Kamar Baru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|max:255|unique:kamars',
            'tipe_kamar' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar_kamar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $kamar = Kamar::create([
            'nomor_kamar' => $validated['nomor_kamar'],
            'tipe_kamar' => $validated['tipe_kamar'],
            'harga' => $validated['harga'],
            'status' => 'belum_terisi',
            'gambar_kamar' => $this->handleImageUpload($request),
        ]);

        return redirect()->route('manajemenKamar.index')
            ->with('success', 'Kamar berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        // Eager load user relationship if it exists
        if ($kamar->user_id) {
            $kamar->load('user');
        }

        return view('owner.roomManagement.edit', [
            'title' => 'Edit Kamar',
            'kamar' => $kamar
        ]);
    }

    /** 
     * Show the confirmation page before deletion
     */
    public function delete(Kamar $kamar)
    {
        return view('owner.roomManagement.delete', [
            'title' => 'Hapus Kamar',
            'kamar' => $kamar
        ]);
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|max:255|unique:kamars,nomor_kamar,' . $kamar->id,
            'tipe_kamar' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:terisi,belum_terisi',
            'gambar_kamar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle status change
        if ($validated['status'] === 'belum_terisi' && $kamar->status === 'terisi') {
            // Jika kamar diubah dari terisi menjadi kosong, hapus referensi user
            $validated['user_id'] = null;
        } 
        else if ($validated['status'] === 'terisi') {
            // Jika status terisi, pertahankan user_id yang ada
            $validated['user_id'] = $kamar->user_id;
        }

        // Handle image upload
        if ($request->hasFile('gambar_kamar')) {
            $validated['gambar_kamar'] = $this->handleImageUpload($request, $kamar);
        }

        // Update data
        $kamar->update($validated);

        return redirect()->route('manajemenKamar.index')
            ->with('success', 'Kamar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        // Periksa apakah kamar sedang terisi oleh penghuni
        if ($kamar->status === 'terisi') {
            return redirect()->route('manajemenKamar.index')
                ->with('error', 'Kamar tidak dapat dihapus karena sedang terisi penghuni');
        }

        // Delete image if exists
        if ($kamar->gambar_kamar) {
            Storage::disk('public')->delete($kamar->gambar_kamar);
        }

        $kamar->delete();

        return redirect()->route('manajemenKamar.index')
            ->with('success', 'Kamar berhasil dihapus');
    }

    /**
     * Handle image upload logic
     */
    protected function handleImageUpload(Request $request, Kamar $kamar = null): ?string
    {
        if (!$request->hasFile('gambar_kamar')) {
            return $kamar->gambar_kamar ?? null;
        }

        // Hapus gambar lama jika ada
        if ($kamar && $kamar->gambar_kamar) {
            Storage::disk('public')->delete($kamar->gambar_kamar);
        }

        // Simpan gambar baru
        return $request->file('gambar_kamar')->store('kamar-images', 'public');
    }
}