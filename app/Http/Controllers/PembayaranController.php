<?php
namespace App\Http\Controllers;

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

    return view('riwayat-pembayaran', compact('pembayarans'));
}
}