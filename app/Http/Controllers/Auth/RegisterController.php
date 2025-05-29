<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required|string|max:20',
            'gender' => 'required|in:L,P',
            'role' => 'required|in:admin,penyewa',
            'foto_profile' => 'nullable|image|max:2048',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($request->hasFile('foto_profile')) {
            $path = $request->file('foto_profile')->store('profile_photos', 'public');
            $validated['foto_profile'] = $path;
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
}