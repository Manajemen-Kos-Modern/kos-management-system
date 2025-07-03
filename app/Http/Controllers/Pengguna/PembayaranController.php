<?php
namespace App\Http\Controllers\Pengguna;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
 
public function index()
{
    $pembayarans = Pembayaran::with('user')
        ->where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('pengguna.riwayat-pembayaran', compact('pembayarans'));
}
}