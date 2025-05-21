<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keluhan;

class ComplaintManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Keluhan::with(['user', 'kamar']);
        
        // Handle search
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhere('keterangan', 'like', "%{$search}%")
            ->orWhere('jenis_keluhan', 'like', "%{$search}%");
        }
        
        $keluhans = $query->latest()->paginate(10);
        
        return view('owner.complaintManagement.index', [
            'title' => 'Manajemen Keluhan',
            'keluhans' => $keluhans
        ]);
    }
    
    public function create()
    {
        return view('owner.complaintManagement.create', [
            'title' => 'Tambah Keluhan'
        ]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'kamar_id' => 'required|exists:kamars,id',
            'keterangan' => 'required|string',
            'jenis_keluhan' => 'required|string',
        ]);
        
        $validated['status'] = 'diterima';
        
        Keluhan::create($validated);
        
        return redirect()->route('owner.complaints.index')
            ->with('success', 'Keluhan berhasil ditambahkan');
    }
    
    public function show(Keluhan $keluhan)
    {
        return view('owner.complaintManagement.show', [
            'title' => 'Detail Keluhan',
            'keluhan' => $keluhan
        ]);
    }
    
    public function edit(Keluhan $keluhan)
    {
        return view('owner.complaintManagement.edit', [
            'title' => 'Edit Keluhan',
            'keluhan' => $keluhan
        ]);
    }
    
    public function update(Request $request, Keluhan $keluhan)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'kamar_id' => 'required|exists:kamars,id',
            'keterangan' => 'required|string',
            'jenis_keluhan' => 'required|string',
        ]);
        
        $keluhan->update($validated);
        
        return redirect()->route('owner.complaints.index')
            ->with('success', 'Keluhan berhasil diperbarui');
    }
    
    public function updateStatus(Request $request, Keluhan $keluhan)
    {
        $validated = $request->validate([
            'status' => 'required|in:diterima,proses,selesai',
        ]);
        
        $keluhan->update($validated);
        
        return redirect()->route('owner.complaints.index')
            ->with('success', 'Status keluhan berhasil diperbarui');
    }
    
    public function destroy(Keluhan $keluhan)
    {
        $keluhan->delete();
        
        return redirect()->route('owner.complaints.index')
            ->with('success', 'Keluhan berhasil dihapus');
    }
}