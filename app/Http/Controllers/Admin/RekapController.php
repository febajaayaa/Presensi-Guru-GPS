<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Presensi;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $bulan    = $request->bulan ?? now()->month;
        $tahun    = $request->tahun ?? now()->year;
        $schoolId = auth()->user()->school_id; // 🔑 kunci isolasi

        // Hanya ambil guru dari sekolah admin yang login
        $gurus = User::where('role', 'guru')
            ->where('school_id', $schoolId)
            ->get();

        $rekap = [];

        foreach ($gurus as $guru) {

            $hadir = Presensi::where('user_id', $guru->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'hadir')
                ->count();

            $terlambat = Presensi::where('user_id', $guru->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'terlambat')
                ->count();

            $sakit = Presensi::where('user_id', $guru->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'sakit')
                ->count();

            $izin = Presensi::where('user_id', $guru->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'izin')
                ->count();

            // ── CUTI: hitung hari cuti yang disetujui dalam bulan ini ──
            $cutiRecords = Cuti::where('user_id', $guru->id)
                ->where('status', 'disetujui')
                ->get();

            $cuti = 0;
            foreach ($cutiRecords as $c) {
                $mulai      = Carbon::parse($c->tanggal_mulai);
                $selesai    = Carbon::parse($c->tanggal_selesai);
                $awalBulan  = Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
                $akhirBulan = Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();
                $start = $mulai->gt($awalBulan) ? $mulai : $awalBulan;
                $end   = $selesai->lt($akhirBulan) ? $selesai : $akhirBulan;
                if ($start->lte($end)) {
                    $cuti += $start->diffInDays($end) + 1;
                }
            }

            $total  = $hadir + $terlambat + $sakit + $izin + $cuti;
            $persen = $total > 0 ? round(($hadir / $total) * 100) : 0;

            $rekap[] = [
                'nama'      => $guru->name,
                'hadir'     => $hadir,
                'terlambat' => $terlambat,
                'sakit'     => $sakit,
                'izin'      => $izin,
                'cuti'      => $cuti,
                'total'     => $total,
                'persen'    => $persen,
            ];
        }

        // Data chart
        $namaGuru      = [];
        $dataHadir     = [];
        $dataTerlambat = [];
        $dataSakit     = [];
        $dataIzin      = [];
        $dataCuti      = [];

        foreach ($rekap as $r) {
            $namaGuru[]      = $r['nama'];
            $dataHadir[]     = $r['hadir'];
            $dataTerlambat[] = $r['terlambat'];
            $dataSakit[]     = $r['sakit'];
            $dataIzin[]      = $r['izin'];
            $dataCuti[]      = $r['cuti'];
        }

        $totalHadir     = array_sum($dataHadir);
        $totalTerlambat = array_sum($dataTerlambat);
        $totalSakit     = array_sum($dataSakit);
        $totalIzin      = array_sum($dataIzin);
        $totalCuti      = array_sum($dataCuti);

        return view('admin.rekap.index', compact(
            'rekap', 'bulan', 'tahun',
            'namaGuru', 'dataHadir', 'dataTerlambat',
            'dataSakit', 'dataIzin', 'dataCuti',
            'totalHadir', 'totalTerlambat', 'totalSakit',
            'totalIzin', 'totalCuti'
        ));
    }

    public function export(Request $request)
    {
        $bulan    = $request->bulan ?? now()->month;
        $tahun    = $request->tahun ?? now()->year;
        $schoolId = auth()->user()->school_id; // 🔑 kunci isolasi

        // Hanya ambil guru dari sekolah admin yang login
        $gurus = User::where('role', 'guru')
            ->where('school_id', $schoolId)
            ->get();

        $rekap = [];

        foreach ($gurus as $guru) {

            $hadir = Presensi::where('user_id', $guru->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'hadir')
                ->count();

            $terlambat = Presensi::where('user_id', $guru->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'terlambat')
                ->count();

            $sakit = Presensi::where('user_id', $guru->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'sakit')
                ->count();

            $izin = Presensi::where('user_id', $guru->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'izin')
                ->count();

            $cutiRecords = Cuti::where('user_id', $guru->id)
                ->where('status', 'disetujui')
                ->get();

            $cuti = 0;
            foreach ($cutiRecords as $c) {
                $mulai      = Carbon::parse($c->tanggal_mulai);
                $selesai    = Carbon::parse($c->tanggal_selesai);
                $awalBulan  = Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
                $akhirBulan = Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();
                $start = $mulai->gt($awalBulan) ? $mulai : $awalBulan;
                $end   = $selesai->lt($akhirBulan) ? $selesai : $akhirBulan;
                if ($start->lte($end)) {
                    $cuti += $start->diffInDays($end) + 1;
                }
            }

            $total  = $hadir + $terlambat + $sakit + $izin + $cuti;
            $persen = $total > 0 ? round(($hadir / $total) * 100) : 0;

            $rekap[] = [
                'nama'      => $guru->name,
                'hadir'     => $hadir,
                'terlambat' => $terlambat,
                'sakit'     => $sakit,
                'izin'      => $izin,
                'cuti'      => $cuti,
                'total'     => $total,
                'persen'    => $persen,
            ];
        }

        $pdf = Pdf::loadView('admin.rekap.pdf', compact('rekap', 'bulan', 'tahun'));
        return $pdf->download('rekap-presensi.pdf');
    }
}