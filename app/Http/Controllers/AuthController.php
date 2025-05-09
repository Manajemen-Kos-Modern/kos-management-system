<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('pengguna.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'no_hp' => 'required|string',
            'gender' => 'required|in:L,P',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'role' => 'pengguna', // default role
            'gender' => $request->gender,
        ]);

        Auth::login($user);

        return redirect()->route('pengguna.login')->with('register_success', 'Registrasi berhasil! Silakan login.');
    }
    public function showLoginForm()
    {
        return view('pengguna.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Arahkan ke pengguna.blade.php
            return redirect()->route('pengguna.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ]);
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard'); // Arahkan ke dashboard admin
            }
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah, atau Anda bukan admin.',
        ]);
    }

    public function showPemilikLoginForm()
    {
        return view('pemilik.auth.login');
    }

    public function pemilikLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'pemilik') {
                $request->session()->regenerate();
                return redirect()->route('pemilik.dashboard'); // Arahkan ke dashboard pemilik
            }
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah, atau Anda bukan pemilik.',
        ]);
    }
}