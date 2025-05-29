<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontrak;
use App\Models\Kamar;
use Illuminate\Support\Facades\Storage;

class PemesananController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'durasi_sewa' => 'required|integer',
            'waktu_pembayaran' => 'required|string',
            'tipe_kamar' => 'required|string',
            'nomor_kamar' => 'required|string',
            'bukti_transfer' => 'required|image|max:2048',
        ]);
        $bukti = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        Kontrak::create([
            'user_id' => auth()->id(),
            'kamar_id' => request()->route('id'), // atau ambil dari hidden input jika perlu
            'tanggal_mulai' => $data['tanggal_mulai'],
            'durasi_sewa' => $data['durasi_sewa'],
            'status' => 'pending',
            'bukti_transfer' => $bukti,
            // tambahkan field lain sesuai kebutuhan
        ]);
        return redirect()->back()->with('success', 'Booking berhasil!');
    }


    public function form($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('pemesanan-kamar', compact('kamar'));
    }
}
