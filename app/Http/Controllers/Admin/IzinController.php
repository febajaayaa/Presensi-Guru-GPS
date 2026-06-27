<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Cuti;
use App\Models\Presensi;
use Carbon\Carbon;

class IzinController extends Controller
{
    public function index()
    {
        $schoolId = auth()->user()->school_id;

        $izins = Pengajuan::with('user')
                    ->whereHas('user', function ($q) use ($schoolId) {
                        $q->where('school_id', $schoolId);
                    })
                    ->whereIn('jenis', ['izin', 'sakit'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        $cutis = Cuti::with('user')
                    ->whereHas('user', function ($q) use ($schoolId) {
                        $q->where('school_id', $schoolId);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();

        // Variabel untuk stat cards di view
        $totalIzin = $izins->count() + $cutis->count();
        $disetujui = $izins->where('status', 'disetujui')->count()
                   + $cutis->where('status', 'disetujui')->count();
        $menunggu  = $izins->where('status', 'pending')->count()
                   + $cutis->where('status', 'pending')->count();

        return view('admin.izin.index', compact(
            'izins', 'cutis',
            'totalIzin', 'disetujui', 'menunggu'
        ));
    }

    public function approve($id)
    {
        $schoolId = auth()->user()->school_id;

        $pengajuan = Pengajuan::whereHas('user', function ($q) use ($schoolId) {
                        $q->where('school_id', $schoolId);
                    })->findOrFail($id);

        $pengajuan->update([
            'status'      => 'disetujui',
            'approved_by' => auth()->id(),
        ]);

        $start = Carbon::parse($pengajuan->tanggal_mulai);
        $end   = Carbon::parse($pengajuan->tanggal_selesai);

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $existing = Presensi::where('user_id', $pengajuan->user_id)
                ->whereDate('tanggal', $date->toDateString())
                ->first();

            if (!$existing) {
                Presensi::create([
                    'user_id'     => $pengajuan->user_id,
                    'tanggal'     => $date->toDateString(),
                    'status'      => $pengajuan->jenis,
                    'izin_status' => 'disetujui',
                    'keterangan'  => $pengajuan->keterangan,
                ]);
            } else {
                $existing->update([
                    'status'      => $pengajuan->jenis,
                    'izin_status' => 'disetujui',
                    'keterangan'  => $pengajuan->keterangan,
                ]);
            }
        }

        return back()->with('success', 'Izin berhasil disetujui.');
    }

    public function reject($id)
    {
        $schoolId = auth()->user()->school_id;

        $pengajuan = Pengajuan::whereHas('user', function ($q) use ($schoolId) {
                        $q->where('school_id', $schoolId);
                    })->findOrFail($id);

        $pengajuan->update([
            'status'      => 'ditolak',
            'approved_by' => auth()->id(),
        ]);

        return back()->with('success', 'Izin berhasil ditolak.');
    }
}