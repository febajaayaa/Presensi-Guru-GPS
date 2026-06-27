<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * TAMPILKAN PROFIL
     */
    public function edit(Request $request): View
    {
        return view('profil', [
            'user' => $request->user(),
        ]);
    }

    /**
     * UPDATE PROFIL + FOTO
     */
   public function update(ProfileUpdateRequest $request): RedirectResponse
{

    $user = $request->user();

    // update manual (hindari bug fill)
    $user->name = $request->name;
    $user->email = $request->email;

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // UPLOAD FOTO
    if ($request->file('photo')) {

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $path = $request->file('photo')->store('profile', 'public');

        $user->photo = $path;
    }

    $user->save();
    

    return Redirect::route('profil')->with('success', 'Profil berhasil diupdate');
}

    
    /**
     * KELOLA AKUN
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // hapus foto jika ada
        if ($user->photo && Storage::exists('public/' . $user->photo)) {
            Storage::delete('public/' . $user->photo);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
}