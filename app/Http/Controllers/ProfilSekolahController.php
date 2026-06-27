<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        return view('profil.index', compact('profil'));
    }

    public function edit()
    {
        $profil = ProfilSekolah::first();
        return view('profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = ProfilSekolah::first() ?? new ProfilSekolah();

        $data = $request->all();

        // Upload logo
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logo', 'public');
            $data['logo'] = $path;
        }

        $profil->fill($data)->save();

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diupdate');
    }
}
