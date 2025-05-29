<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Validasi dan upload foto_profile jika ada
        if ($request->hasFile('foto_profile')) {
            $request->validate([
                'foto_profile' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Hapus foto lama jika ada
            if ($user->foto_profile && Storage::disk('public')->exists($user->foto_profile)) {
                Storage::disk('public')->delete($user->foto_profile);
            }

            // Simpan foto baru
            $path = $request->file('foto_profile')->store('profile_photos', 'public');
            if ($path) {
                $user->foto_profile = $path;
            }
        }

        // Update data lain
        $user->fill($request->only(['nama', 'email', 'no_hp', 'gender']));
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Display the user's profile information.
     */
    public function show(Request $request)
    {
        return view('profile.profile', [
            'user' => $request->user(),
        ]);
    }
}