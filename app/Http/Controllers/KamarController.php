<?php
namespace App\Http\Controllers;

use App\Models\Kamar;

class KamarController extends Controller
{
    public function show($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('detail-kamar', compact('kamar'));
    }
}