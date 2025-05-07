<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManajemenPenyewaController extends Controller
{
    public function index() {
        return view ('admin.manajemenPenyewa.index', [
            'title' => 'Manajemen Penyewa',
        ]);
    }
}