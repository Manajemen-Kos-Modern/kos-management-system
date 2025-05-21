<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pemeliharaan;
use App\Models\Kamar;
use Illuminate\Http\Request;

class PemeliharaanController extends Controller
{
    public function index()
    {
        $pemeliharaans = Pemeliharaan::with('kamar')->latest()->get();
        return view('admin.pemeliharaan.index', compact('pemeliharaans'));
    }

    public function create()
{
    $kamars = Kamar::whereDoesntHave('pemeliharaans', function($query) {
        $query->where('status', 'sedang-proses');
    })->get();
    
    return view('admin.pemeliharaan.create', compact('kamars'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kamar_id' => 'required|exists:kamars,id|unique:pemeliharaans,kamar_id,NULL,id,status,sedang-proses',
            'keterangan' => 'required|string|max:500',
            'status' => 'required|in:sedang-proses,selesai',
        ]);

        Pemeliharaan::create($validated);

        return redirect()->route('admin.pemeliharaan.index')
            ->with('success', 'Data pemeliharaan berhasil ditambahkan');
    }

    public function destroy(Pemeliharaan $pemeliharaan)
    {
        $pemeliharaan->delete();

        return redirect()->route('admin.pemeliharaan.index')
            ->with('success', 'Data pemeliharaan berhasil dihapus');
    }
}