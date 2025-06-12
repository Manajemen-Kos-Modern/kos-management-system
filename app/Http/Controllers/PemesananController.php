<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontrak;
use App\Models\Pembayaran;
use App\Models\Kamar;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'harga' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'durasi_sewa' => 'required|integer',
            'waktu_pembayaran' => 'required|string',
            'bukti_transfer' => 'required|image|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // 1. Simpan kontrak
            $kontrak = Kontrak::create([
                'user_id' => auth()->id(),
                'kamar_id' => $request->kamar_id,
                'tanggal_mulai' => $request->tanggal_mulai,
                'durasi_sewa' => $request->durasi_sewa,
                'status' => 'aktif',
            ]);

            // Update status dan user_id di tabel kamar
            $kamar = Kamar::find($request->kamar_id);
            if ($kamar) {
                $kamar->status = 'terisi';
                $kamar->user_id = auth()->id();
                $kamar->save();
            }

            // 2. Simpan bukti transfer
            $bukti_transfer = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

            // 3. Hitung harga sesuai tipe pembayaran
            $harga = $data['harga'];
            if ($request->waktu_pembayaran === 'Lunas') {
                $harga = $data['harga'] * $request->durasi_sewa;
            }

            // 4. Simpan pembayaran
            Pembayaran::create([
                'kontrak_id' => $kontrak->id,
                'user_id' => auth()->id(),
                'harga' => $harga,
                'metode_pembayaran' => 'transfer',
                'waktu_pembayaran' => $request->waktu_pembayaran,
                'bukti_transfer' => $bukti_transfer,
                'status' => 'menunggu',
            ]);

            DB::commit();
            return redirect()->route('riwayat.pembayaran')->with('success', 'Pemesanan berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['msg' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function form($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('pemesanan-kamar', compact('kamar'));
    }

    public function kontrakSaya()
    {
        $kontraks = Kontrak::where('user_id', auth()->id())
            ->with(['kamar', 'pembayaran'])
            ->latest()
            ->get();
        return view('kontrak-saya', compact('kontraks'));
    }
}