<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Tampilkan semua data pembayaran.
     */
    public function index()
    {
        $pembayarans = Pembayaran::with(['user', 'kontrak'])->latest()->get();
        return view('admin.pembayarans.index', compact('pembayarans'));
    }

    /**
     * Konfirmasi pembayaran (ubah status menjadi 'sukses').
     */
    public function konfirmasi($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = 'sukses';
        $pembayaran->save();

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    /**
     * Tolak pembayaran (ubah status menjadi 'gagal').
     */
    public function tolak($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = 'gagal';
        $pembayaran->save();

        return redirect()->back()->with('error', 'Pembayaran telah ditolak.');
    }
}
