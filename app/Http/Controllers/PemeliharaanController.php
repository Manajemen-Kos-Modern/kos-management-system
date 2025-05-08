<?php
namespace App\Http\Controllers;

use App\Models\Pemeliharaan;
use App\Models\Kamar;
use Illuminate\Http\Request;

class PemeliharaanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $data = Pemeliharaan::with('kamar')->latest()->get();
        return view('pemeliharaan.index', compact('data'));
    }

    public function create()
    {
        $kamars = Kamar::all();
        return view('pemeliharaan.create', compact('kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'status' => 'required|string',
            'keterangan' => 'nullable|string'
        ]);

        Pemeliharaan::create($request->all());

        return redirect()->route('pemeliharaan.index')->with('success', 'Data pemeliharaan ditambahkan');
    }

    public function destroy($id)
    {
        Pemeliharaan::destroy($id);
        return redirect()->route('pemeliharaan.index')->with('success', 'Data pemeliharaan dihapus');
    }
}
