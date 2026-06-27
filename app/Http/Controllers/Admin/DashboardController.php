<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Presensi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $schoolId = auth()->user()->school_id; // 🔑 kunci utama

    // ── TOTAL (hanya sekolah admin yang login) ──
    $totalUser = User::where('role', 'guru')
        ->where('school_id', $schoolId)
        ->count();

    $totalPresensi = Presensi::whereHas('user', fn($q) =>
        $q->where('school_id', $schoolId)
    )->count();

    $hadir = Presensi::whereHas('user', fn($q) =>
        $q->where('school_id', $schoolId)
    )->where('status', 'hadir')->count();

    $terlambat = Presensi::whereHas('user', fn($q) =>
        $q->where('school_id', $schoolId)
    )->where('status', 'terlambat')->count();

    $izin = Presensi::whereHas('user', fn($q) =>
        $q->where('school_id', $schoolId)
    )->where('status', 'izin')
     ->whereIn('izin_status', ['disetujui', 'pending'])->count();

    $sakit = Presensi::whereHas('user', fn($q) =>
        $q->where('school_id', $schoolId)
    )->where('status', 'sakit')
     ->whereIn('izin_status', ['disetujui', 'pending'])->count();

    // ── CHART TAHUNAN ──
    $bulan = []; $dataHadir = []; $dataTerlambat = [];
    for ($i = 1; $i <= 12; $i++) {
        $bulan[] = date('M', mktime(0, 0, 0, $i, 1));
        $base = Presensi::whereHas('user', fn($q) =>
            $q->where('school_id', $schoolId)
        )->whereMonth('tanggal', $i)->whereYear('tanggal', now()->year);

        $dataHadir[]     = (clone $base)->where('status', 'hadir')->count();
        $dataTerlambat[] = (clone $base)->where('status', 'terlambat')->count();
    }

    // ── REKAP BULAN INI ──
    $baseBulan = Presensi::whereHas('user', fn($q) =>
        $q->where('school_id', $schoolId)
    )->whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year);

    $hadirBulanIni     = (clone $baseBulan)->where('status', 'hadir')->count();
    $terlambatBulanIni = (clone $baseBulan)->where('status', 'terlambat')->count();

    // ── DATA TERBARU ──
    $data = Presensi::with('user')
        ->whereHas('user', fn($q) => $q->where('school_id', $schoolId))
        ->where(fn($q) => $q
            ->whereIn('status', ['hadir', 'terlambat'])
            ->orWhere(fn($q2) => $q2
                ->whereIn('status', ['izin', 'sakit'])
                ->where('izin_status', 'disetujui')
                ->whereDate('tanggal', '<=', today())
            )
        )
        ->latest('tanggal')->take(10)->get();

    // ── DATA SEKOLAH untuk tampilan identitas ── 🆕
    $school = auth()->user()->school;

    return view('admin.dashboard', compact(
        'totalUser', 'totalPresensi', 'hadir', 'terlambat',
        'izin', 'sakit', 'bulan', 'dataHadir', 'dataTerlambat',
        'hadirBulanIni', 'terlambatBulanIni', 'data', 'school' // 🆕
    ));
}
}