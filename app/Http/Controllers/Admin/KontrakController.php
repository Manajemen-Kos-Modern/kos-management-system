<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Kontrak;  // Pastikan kamu punya model Kontrak

class KontrakController extends Controller
{

public function index()
{
    // ambil data kontrak beserta user dan kamar supaya eager loading
    $kontraks = Kontrak::with(['user', 'kamar'])->get();

    return view('admin.kontrak.index', compact('kontraks'));
}

}
