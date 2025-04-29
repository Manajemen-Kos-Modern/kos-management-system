<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    // Menampilkan semua kamar
    public function index()
    {
        $kamars = Kamar::all();
        return view('admin.kamar.index', compact('kamars'));
    }

    // Menampilkan form tambah kamar
    public function create()
    {
        return view('admin.kamar.create');
    }

    // Menyimpan kamar baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|string|max:255',
            'tipe_kamar' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'status' => 'required|in:belum_terisi,terisi',
        ]);

        Kamar::create([
            'nomor_kamar' => $request->nomor_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'harga' => $request->harga,
            'status' => $request->status,
            'user_id' => auth()->id(), // otomatis ambil user login
        ]);

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    // Menampilkan form edit kamar
    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('admin.kamar.edit', compact('kamar'));
    }

    // Mengupdate kamar
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_kamar' => 'required|string|max:255',
            'tipe_kamar' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'status' => 'required|in:belum_terisi,terisi',
        ]);

        $kamar = Kamar::findOrFail($id);
        $kamar->update([
            'nomor_kamar' => $request->nomor_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'harga' => $request->harga,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil diupdate.');
    }

    // Menghapus kamar
    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
