<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class KeluhanController extends Controller
{
    // Admin melihat semua keluhan
    public function index()
    {
        $keluhans = Keluhan::with(['user', 'kamar']) // Eager load user dan kamar
        ->orderBy('created_at', 'desc')
        ->get();
        return view('admin.keluhan.index', compact('keluhans')); // Mengirimkan data ke view
    }

    // User mengisi keluhan
    public function create()
    {
        return view('admin.keluhan.create');
    }

    public function edit($id)
    {
        // Ambil data keluhan berdasarkan ID
        $keluhan = Keluhan::with('user')->findOrFail($id);
        
        // Kembalikan view edit dengan data keluhan
        return view('admin.keluhan.edit', compact('keluhan'));
    }
   
    public function update(Request $request, $id)
{
    $request->validate([
        'keterangan' => 'required|string',
        'jenis_keluhan' => 'required|string',
        'status' => 'required|string',
    ]);

    $keluhan = Keluhan::findOrFail($id);
    $keluhan->update([
        'keterangan' => $request->keterangan,
        'jenis_keluhan' => $request->jenis_keluhan,
        'status' => $request->status,
    ]);

    return redirect()->route('admin.keluhan.index')->with('success', 'Keluhan berhasil diperbarui.');
}


    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|integer',
            'jenis_keluhan' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        Keluhan::create([
            'user_id' => Auth::id(),
            'kamar_id' => $request->kamar_id,
            'jenis_keluhan' => $request->jenis_keluhan,
            'keterangan' => $request->keterangan,
            'status' => 'diterima',
        ]);

        return redirect()->route('keluhan.create')->with('success', 'Keluhan berhasil dikirim.');
    }

    // Admin update status keluhan
    public function updateStatus(Request $request, $id)
    {
        $keluhan = Keluhan::findOrFail($id);
        $keluhan->status = $request->status;
        $keluhan->save();
    
        return back()->with('success', 'Status diperbarui.');
    }
    
    public function tanggapi(Request $request, $id)
    {
        $keluhan = Keluhan::findOrFail($id);
        $keluhan->tanggapan = $request->tanggapan;
        $keluhan->save();
    
        return back()->with('success', 'Tanggapan berhasil dikirim.');
    }
    
    public function destroy($id)
    {
        $keluhan = Keluhan::findOrFail($id);
        $keluhan->delete();
    
        return back()->with('success', 'Keluhan dihapus.');
    }
    
}
