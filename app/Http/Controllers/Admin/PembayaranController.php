<?php

namespace App\Http\Controllers\Admin;

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
  
public function verify($id)
{
    $pembayaran = Pembayaran::findOrFail($id);
    // Contoh: update status jadi sukses, sesuaikan sesuai logic kamu
    $pembayaran->status = 'sukses';
    $pembayaran->save();

    return redirect()->route('admin.pembayarans.index')->with('success', 'Pembayaran berhasil diverifikasi.');
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
