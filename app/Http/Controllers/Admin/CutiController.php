<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Http\Controllers\Controller;

class CutiController extends Controller
{
   public function index()
{
    // Khusus GURU — hanya lihat cuti milik sendiri
    $cutis = Cuti::where('user_id', auth()->id())
                 ->orderBy('created_at', 'desc')
                 ->get();

    return view('user.cuti.index', compact('cutis'));
}

    public function adminIndex()
{
    $schoolId = auth()->user()->school_id;

    $cutis = Cuti::with('user')
                ->whereHas('user', function ($q) use ($schoolId) {
                    $q->where('school_id', $schoolId);
                })
                ->paginate(10);

    $izins = Pengajuan::with('user')
                ->whereHas('user', function ($q) use ($schoolId) {
                    $q->where('school_id', $schoolId);
                })
                ->where('jenis', 'izin')
                ->paginate(10);

    return view('admin.cuti.index', compact('cutis', 'izins'));
}

    public function create()
    {
        return view('user.cuti.create');
    }

    public function store(Request $request)
    {
       $request->validate([
    'jenis_cuti'     => 'required|string',
    'tanggal_mulai'  => 'required|date',
    'tanggal_selesai'=> 'required|date|after_or_equal:tanggal_mulai',
    'alasan'         => 'required',
]);

Cuti::create([
    'user_id'        => Auth::id(),
    'jenis_cuti'     => $request->jenis_cuti,
    'tanggal_mulai'  => $request->tanggal_mulai,
    'tanggal_selesai'=> $request->tanggal_selesai,
    'alasan'         => $request->alasan,
    'status'         => 'pending'
]);

        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil diajukan');
    }

    public function approve($id)
{
    $schoolId = auth()->user()->school_id;
    
    $cuti = Cuti::whereHas('user', function ($q) use ($schoolId) {
                    $q->where('school_id', $schoolId);
                })->findOrFail($id);
    
    $cuti->update(['status' => 'disetujui']);
    
    return back()->with('success', 'Cuti berhasil disetujui.');
}

public function reject($id)
{
    $schoolId = auth()->user()->school_id;
    
    $cuti = Cuti::whereHas('user', function ($q) use ($schoolId) {
                    $q->where('school_id', $schoolId);
                })->findOrFail($id);
    
    $cuti->update(['status' => 'ditolak']);
    
    return back()->with('success', 'Cuti berhasil ditolak.');
}
}