<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kamar;
use App\Models\Kontrak;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'pengguna')->with(['kontrak.kamar']);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        $penyewas = $query->paginate(10);
        return view('admin.penyewa.index', compact('penyewas'));
    }

    public function create()
    {
        $kamars = Kamar::where('status', 'belum_terisi')->get();
        return view('admin.penyewa.create', compact('kamars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|string|max:20',
            'gender' => 'required|in:L,P',
            'nomor_kamar' => 'required|exists:kamars,nomor_kamar',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        // Buat user baru
        $user = User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'gender' => $validated['gender'],
            'role' => 'pengguna',
            'password' => bcrypt('defaultpassword'),
        ]);

        // Cari kamar dan buat kontrak
        $kamar = Kamar::where('nomor_kamar', $validated['nomor_kamar'])->first();

        Kontrak::create([
            'user_id' => $user->id,
            'kamar_id' => $kamar->id,
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'status' => 'aktif',
        ]);

        // Update status kamar
        $kamar->status = 'terisi';
        $kamar->save();

        return redirect()->route('admin.penyewa.index')->with('success', 'Penyewa berhasil ditambahkan');
    }

    public function edit(User $penyewa)
    {
        $kamars = Kamar::where('status', 'belum_terisi')
            ->orWhereHas('kontrak', function ($query) use ($penyewa) {
                $query->where('user_id', $penyewa->id)->where('status', 'aktif');
            })->get();

        $kontrak = $penyewa->kontrak()->where('status', 'aktif')->first();

        return view('admin.penyewa.edit', compact('penyewa', 'kamars', 'kontrak'));
    }

    public function update(Request $request, User $penyewa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $penyewa->id,
            'no_hp' => 'required|string|max:20',
            'gender' => 'required|in:L,P',
            'nomor_kamar' => 'required|exists:kamars,nomor_kamar',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $penyewa->update([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'gender' => $validated['gender'],
        ]);

        $kontrak = $penyewa->kontrak()->where('status', 'aktif')->first();
        $newKamar = Kamar::where('nomor_kamar', $validated['nomor_kamar'])->first();

        if ($kontrak) {
            $oldKamar = $kontrak->kamar;

            // Update kontrak
            $kontrak->update([
                'kamar_id' => $newKamar->id,
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'tanggal_selesai' => $validated['tanggal_selesai'],
            ]);

            // Update status kamar jika kamar diganti
            if ($oldKamar->id !== $newKamar->id) {
                $oldKamar->status = 'belum_terisi';
                $oldKamar->save();

                $newKamar->status = 'terisi';
                $newKamar->save();
            }
        }

        return redirect()->route('admin.penyewa.index')->with('success', 'Data penyewa berhasil diperbarui');
    }

    public function destroy(User $penyewa)
    {
        $kontrak = $penyewa->kontrak()->where('status', 'aktif')->first();

        if ($kontrak) {
            $kamar = $kontrak->kamar;
            $kamar->status = 'belum_terisi';
            $kamar->save();

            // Nonaktifkan kontrak
            $kontrak->status = 'nonaktif';
            $kontrak->save();
        }

        $penyewa->delete();

        return redirect()->route('admin.penyewa.index')->with('success', 'Penyewa berhasil dihapus');
    }
}
