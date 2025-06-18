<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class NotifikasiController extends Controller
{
    // Tampilkan semua notifikasi (admin)
    public function index()
    {
        $notifikasis = Notifikasi::orderBy('waktu_kirim', 'desc')->paginate(10);
        return view('admin.notifikasi.index', compact('notifikasis'));
    }

    // Tampilkan form buat notifikasi baru (admin)
    public function create()
    {
        return view('admin.notifikasi.create');
    }

    // Simpan notifikasi baru (admin)
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id', // null = semua user
            'pesan' => 'required|string',
            'status' => 'required|in:terkirim,dibaca',
            'waktu_kirim' => 'required|date',
        ]);

        Notifikasi::create($request->all());

        return redirect()->route('admin.notifikasi.index')->with('success', 'Notifikasi berhasil dibuat.');
    }

    // Tampilkan form edit notifikasi (admin)
    public function edit($id)
{
    $notifikasi = Notifikasi::findOrFail($id);
    $users = User::all(); // Ambil semua user untuk dropdown

    return view('admin.notifikasi.edit', compact('notifikasi', 'users'));
}


    // Update notifikasi (admin)
    public function update(Request $request, Notifikasi $notifikasi)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'pesan' => 'required|string',
            'status' => 'required|in:terkirim,dibaca',
            'waktu_kirim' => 'required|date',
        ]);

        $notifikasi->update($request->all());

        return redirect()->route('admin.notifikasi.index')->with('success', 'Notifikasi berhasil diupdate.');
    }

    // Hapus notifikasi (admin)
    public function destroy(Notifikasi $notifikasi)
    {
        $notifikasi->delete();
        return redirect()->route('admin.notifikasi.index')->with('success', 'Notifikasi berhasil dihapus.');
    }

    // Tampilkan notifikasi untuk user yang sedang login
    public function userIndex()
    {
        $userId = Auth::id();
        $notifikasis = Notifikasi::where('user_id', $userId)
                                ->orWhereNull('user_id') // Notifikasi untuk semua
                                ->orderBy('waktu_kirim', 'desc')
                                ->paginate(10);

        return view('notifikasi.user_index', compact('notifikasis'));
    }
}
