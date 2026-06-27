<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::all();
        return view('admin.schools', compact('schools'));
    }

    public function create()
    {
        return view('admin.create-school');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:150',
            'latitude'     => 'required',
            'longitude'    => 'required',
            'radius'       => 'required|numeric',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $data = $request->only([
            'nama_sekolah','npsn','akreditasi','kota','alamat',
            'deskripsi','no_telepon','kepala_sekolah',
            'latitude','longitude','radius',
        ]);

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        School::create($data);

        return redirect()->route('superadmin.schools')->with('success', 'Sekolah berhasil ditambahkan');
    }

    public function edit($id)
    {
        $school = School::findOrFail($id);
        return view('admin.edit-school', compact('school'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:150',
            'latitude'     => 'required',
            'longitude'    => 'required',
            'radius'       => 'required|numeric',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $school = School::findOrFail($id);

        $data = $request->only([
            'nama_sekolah','npsn','akreditasi','kota','alamat',
            'deskripsi','no_telepon','kepala_sekolah',
            'latitude','longitude','radius',
        ]);

        // Ganti logo jika ada file baru
        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($school->logo) {
                Storage::disk('public')->delete($school->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $school->update($data);

        return redirect()->route('superadmin.schools')->with('success', 'Sekolah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $school = School::findOrFail($id);

        // Hapus logo saat sekolah dihapus
        if ($school->logo) {
            Storage::disk('public')->delete($school->logo);
        }

        $school->delete();
        return redirect()->route('superadmin.schools')->with('success', 'Sekolah berhasil dihapus');
    }
}