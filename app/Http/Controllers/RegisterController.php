<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('register.register', [
            'title' => 'Register',
        
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:25',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255',
            'password_confirmation' => 'required|same:password',
        ]);
        
        $validated['password'] = Hash::make($validated['password']);

        User::create([
            "first_name" => $validated["first_name"],
            "last_name" => $validated["last_name"],
            "email" => $validated["email"],
            "password" => $validated["password"]
        ]);

        return redirect('/login')->with("register_success", "Succeed to create the account, please login again");
        dd($request);
    }
}