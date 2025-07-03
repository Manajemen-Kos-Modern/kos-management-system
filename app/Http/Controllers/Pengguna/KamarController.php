<?php
namespace App\Http\Controllers\Pengguna;
use App\Http\Controllers\Controller;
use App\Models\Kamar;

class KamarController extends Controller
{
    public function show($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('pengguna.detail-kamar', compact('kamar'));
    }
}