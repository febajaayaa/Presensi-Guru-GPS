<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaIzinController extends Controller
{
    /**
     * Tampilkan riwayat izin mahasiswa yang login.
     */
    public function index()
    {
        $izins = Pengajuan::where('user_id', Auth::id())
            ->whereIn('jenis', ['izin', 'sakit'])
            ->latest()
            ->get();

        return view('izin.index', [
            'izins'     => $izins,
            'totalIzin' => $izins->count(),
            'disetujui' => $izins->where('status', 'disetujui')->count(),
            'menunggu'  => $izins->whereIn('status', ['menunggu', 'pending'])->count(),
        ]);
    }

    /**
     * Tampilkan form pengajuan izin.
     */
    public function form()
    {
        return view('izin.form');
    }

    /**
     * Simpan pengajuan izin baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status'        => 'required|string|max:100',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'keterangan'    => 'required|string|min:10|max:300',
            'lampiran'      => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ], [
            'status.required'              => 'Jenis izin wajib dipilih.',
            'tanggal_mulai.required'       => 'Tanggal izin wajib diisi.',
            'tanggal_mulai.after_or_equal' => 'Tanggal tidak boleh di masa lalu.',
            'keterangan.required'          => 'Keterangan wajib diisi.',
            'keterangan.min'               => 'Keterangan minimal 10 karakter.',
        ]);

        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')
                ->store('lampiran-izin', 'public');
        }

        Pengajuan::create([
            'user_id'        => Auth::id(),
            'jenis'          => 'izin',
            'status'         => 'menunggu',
            'tanggal_mulai'  => $request->tanggal_mulai,
            'tanggal_selesai'=> $request->tanggal_mulai, // izin = 1 hari
            'keterangan'     => $request->keterangan,
            'lampiran'       => $lampiranPath,
        ]);

        return redirect()->route('izin.index')
            ->with('success', 'Pengajuan izin berhasil dikirim. Tunggu persetujuan dalam 1–2 hari kerja.');
    }

    /**
     * Batalkan pengajuan izin (hanya jika masih menunggu).
     */
    public function destroy($id)
    {
        $pengajuan = Pengajuan::where('user_id', Auth::id())
            ->whereIn('status', ['menunggu', 'pending'])
            ->findOrFail($id);

        $pengajuan->delete();

        return redirect()->route('izin.index')
            ->with('success', 'Pengajuan izin berhasil dibatalkan.');
    }
}