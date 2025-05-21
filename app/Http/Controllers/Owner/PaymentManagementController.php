<?php
namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran; // Tambahkan import ini

class PaymentManagementController extends Controller
{
    public function index(Request $request) {
        // Ambil query pencarian jika ada
        $search = $request->query('search');
        
        // Query data pembayaran dengan relasi user dan fitur pencarian
        $query = Pembayaran::with('user');
        
        if ($search) {
            $query->whereHas('user', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            })
            ->orWhere('status', 'like', "%{$search}%");
        }
        
        // Pagination hasil query
        $pembayarans = $query->paginate(10);
        
        // Kirim data ke view
        return view('owner.paymentManagement.index', [
            'title' => 'Manajemen Pembayaran',
            'pembayarans' => $pembayarans // Ini yang penting: mengirim variabel pembayarans ke view
        ]);
    }

    public function viewFile($id) {
        $pembayaran = Pembayaran::findOrFail($id);
        
        // Pastikan file bukti transfer ada
        if (!$pembayaran->bukti_transfer) {
            return redirect()->route('manajemenPembayaran.index')
                ->with('error', 'File bukti transfer tidak ditemukan');
        }
        
        // Jika ingin menampilkan file di browser
        return response()->file(storage_path('app/public/' . $pembayaran->bukti_transfer));
        
        // Atau jika ingin mendownload file
        // return Storage::download('public/' . $pembayaran->bukti_transfer);
    }    
    
    // Tambahkan method untuk verifikasi pembayaran
    public function verify($id) {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = 'lunas';
        $pembayaran->save();
        
        return redirect()->route('manajemenPembayaran.index')
            ->with('success', 'Pembayaran berhasil diverifikasi');
    }

    public function cancel($id) {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = 'belum-lunas';
        $pembayaran->save();
        
        return redirect()->route('manajemenPembayaran.index')
            ->with('success', 'Pembayaran dibatalkan');
    }
}