<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\School;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuruImport;

class GuruController extends Controller
{
    // Helper: ambil school_id dari admin yang login
    // school_id SELALU dari auth(), tidak bisa dimanipulasi user
    private function mySchoolId(): int
    {
        return auth()->user()->school_id;
    }

    // LIST GURU — hanya guru sekolah sendiri
    public function index()
    {
        $guru = User::where('role', 'guru')
                    ->where('school_id', $this->mySchoolId())
                    ->get();

        return view('admin.guru.index', compact('guru'));
    }

    // FORM TAMBAH GURU
    public function create()
    {
        $schools = School::all();

        return view('admin.guru.create', compact('schools'));
    }

    // SIMPAN GURU — school_id otomatis dari admin login
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role'      => 'guru',
            'school_id' => $this->mySchoolId(),
        ]);

        return redirect()->route('guru.index')
                         ->with('success', 'Guru berhasil ditambahkan.');
    }

    // FORM EDIT GURU — pastikan guru ini milik sekolah admin
    public function edit($id)
    {
        $guru    = User::where('id', $id)
                       ->where('school_id', $this->mySchoolId())
                       ->firstOrFail();
        $schools = School::all();

        return view('admin.guru.edit', compact('guru', 'schools'));
    }

    // UPDATE GURU
    // FIX: tambah validasi lengkap + unique email ignore id sendiri
    public function update(Request $request, $id)
    {
        $guru = User::where('id', $id)
                    ->where('school_id', $this->mySchoolId()) // cegah edit guru sekolah lain
                    ->firstOrFail();

        $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', Rule::unique('users')->ignore($guru->id)],
            'password' => ['nullable', 'string', 'min:8'],
        ], [
            'name.required'  => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email ini sudah digunakan akun lain.',
            'password.min'   => 'Password minimal 8 karakter.',
        ]);

        $guru->name  = $request->name;
        $guru->email = $request->email;
        // school_id TIDAK boleh diubah dari form

        if ($request->filled('password')) {
            $guru->password = Hash::make($request->password);
        }

        $guru->save();

        return redirect()->route('guru.index')
                         ->with('success', "Data guru {$guru->name} berhasil diperbarui.");
    }

    // HAPUS GURU — validasi kepemilikan sebelum hapus
    public function destroy($id)
    {
        $guru = User::where('id', $id)
                    ->where('school_id', $this->mySchoolId()) // cegah hapus guru sekolah lain
                    ->firstOrFail();

        $nama = $guru->name;
        $guru->delete();

        return redirect()->route('guru.index')
                         ->with('success', "Guru {$nama} berhasil dihapus.");
    }

    // IMPORT EXCEL
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new GuruImport($this->mySchoolId()), $request->file('file'));

        return redirect()->route('guru.index')
                         ->with('success', 'Data guru berhasil diimport.');
    }
}