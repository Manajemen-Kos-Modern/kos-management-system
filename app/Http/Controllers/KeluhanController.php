<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    public function index()
    {
        $keluhan = \App\Models\Keluhan::with(['user', 'kamar'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('keluhan', compact('keluhan'));
    }

    public function form()
    {
        $user = auth()->user();
        // Ambil kamar user, sesuaikan relasi jika perlu
        $kamar = \App\Models\Kamar::where('user_id', $user->id)->first();

        return view('form-keluhan', compact('user', 'kamar'));
    }

    public function store(Request $request)
    {
        // Validasi data jika diperlukan
        // $request->validate([
        //     'keterangan' => 'required',
        //     'jenis_keluhan' => 'required',
        //     // tambahkan validasi lain jika perlu
        // ]);

        \App\Models\Keluhan::create([
            'user_id' => auth()->id(),
            'kamar_id' => $request->kamar_id, // pastikan field ini dikirim jika diperlukan
            'keterangan' => $request->keterangan,
            'status' => 'pending', // atau sesuai kebutuhan
            'jenis_keluhan' => $request->jenis_keluhan,
        ]);
        return redirect()->route('keluhan.index')->with('success', 'Keluhan berhasil dikirim.');
    }
}