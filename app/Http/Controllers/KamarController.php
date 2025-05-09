<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KamarController extends Controller
{
    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function index()
    {
        $this->authorizeAdmin();

        $kamars = Kamar::all();
        return view('admin.kamar.index', compact('kamars'));
    }

    public function create()
    {
        $this->authorizeAdmin();

        return view('admin.kamar.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nomor_kamar' => 'required',
            'tipe_kamar' => 'required',
            'harga' => 'required|numeric|min:0',
            'status' => 'required',
        ]);

        Kamar::create([
            'user_id' => Auth::id(),
            'nomor_kamar' => $request->input('nomor_kamar'),
            'tipe_kamar' => $request->input('tipe_kamar'),
            'harga' => $request->input('harga'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }


    public function show(Kamar $kamar)
    {
        $this->authorizeAdmin();

        return view('admin.kamar.show', compact('kamar'));
    }

    public function edit(Kamar $kamar)
    {
        $this->authorizeAdmin();

        // panggil data kamar berdasarkan ID
        // $kamar = Kamar::findOrFail($id);

        return view('admin.kamar.edit', compact('kamar'));
    }

    public function update(Request $request, Kamar $kamar)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nomor_kamar' => 'required',
            'tipe_kamar' => 'required',
            'harga' => 'required|numeric|min:0',
            'status' => 'required',
        ]);

        $kamar->update($request->all());

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil diupdate.');
    }

    public function destroy(Kamar $kamar)
    {
        $this->authorizeAdmin();

        $kamar->delete();
        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
