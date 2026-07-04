<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Cuti;
use App\Models\School;
use Carbon\Carbon;

class PresensiController extends Controller
{
    // =========================
    // DASHBOARD USER
    // =========================
    public function index()
    {
        $user = auth()->user(); // ✅ FIX 1: definisikan $user

        $data = Presensi::where('user_id', $user->id)->latest()->get();

        $today = Presensi::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->first();

        $todayCuti = Cuti::where('user_id', $user->id)
            ->whereDate('tanggal_mulai', '<=', today())
            ->whereDate('tanggal_selesai', '>=', today())
            ->first();

        $hadir = Presensi::where('user_id', $user->id)->where('status', 'hadir')->count();
        $terlambat = Presensi::where('user_id', $user->id)->where('status', 'terlambat')->count();
        $sakit = Presensi::where('user_id', $user->id)->where('status', 'sakit')->count();
        $izin = Presensi::where('user_id', $user->id)->where('status', 'izin')->count();
        $cuti = Cuti::where('user_id', $user->id)
             ->where('status', 'disetujui')
             ->count();
        $izinPending = \App\Models\Pengajuan::where('user_id', $user->id)
                    ->whereDate('created_at', today()) // ✅ FIX 2: pakai today() bukan $today
                    ->whereIn('status', ['pending', 'disetujui'])
                    ->latest()
                    ->first();

        return view('dashboard', compact(
            'data',
            'today',
            'todayCuti',
            'hadir',
            'terlambat',
            'sakit',
            'izin',
            'cuti',
            'izinPending',
        ));
    }

   public function masuk(Request $request)
{
    $user = auth()->user();

    $school = School::find($user->school_id);
    if (!$school) {
        return back()->with('error', 'Data sekolah belum disetting');
    }

    $latUser = $request->latitude;
    $lngUser = $request->longitude;

    if (!$latUser || !$lngUser) {
        return back()->with('error', 'GPS tidak terdeteksi');
    }

    $distance = $this->hitungJarak(
        $latUser,
        $lngUser,
        $school->latitude,
        $school->longitude
    );

    if ($distance > $school->radius) {
        return back()->with('error', 'Kamu di luar area sekolah!');
    }

    $today = Presensi::where('user_id', $user->id)
    ->whereDate('tanggal', today())
    ->first();

// Jika ada izin/sakit yang masih pending
if (
    $today &&
    in_array($today->status, ['izin', 'sakit']) &&
    $today->izin_status === 'pending'
) {
    return back()->with(
        'error',
        'Pengajuan izin/sakit Anda masih menunggu persetujuan admin.'
    );
}

// Sudah absen masuk
if ($today && $today->jam_masuk) {
    return back()->with('error', 'Sudah absen masuk');
}
    // ⛳ tentukan status
    $status = now()->format('H:i:s') <= '07:00:00' ? 'hadir' : 'terlambat';

    // 🔥 JIKA IZIN / CUTI DITOLAK → paksa jadi HADIR
    if ($today && $today->izin_status == 'ditolak') {
        $status = 'hadir';
    }

    // 🔥 CREATE jika belum ada data hari ini
    if (!$today) {
        Presensi::create([
            'user_id' => $user->id,
            'tanggal' => today(),
            'jam_masuk' => now(),
            'status' => $status,
        ]);

        return back()->with('success', 'Berhasil presensi masuk');
    }

    // 🔥 UPDATE jika sudah ada record (misalnya dari izin/cuti)
    $status = now()->format('H:i:s') <= '07:00:00'
    ? 'hadir'
    : 'terlambat';

// Jika sebelumnya izin/cuti ditolak, paksa jadi hadir
if (
    $today->izin_status == 'ditolak'
    || $today->status == 'cuti'
) {
    $status = 'hadir';
}

$today->update([
    'jam_masuk' => now(),
    'status' => $status,
    'izin_status' => $today->izin_status ?? 'pending',
]);

    return back()->with('success', 'Berhasil presensi masuk');
}

    // =========================
    // PRESENSI KELUAR
    // =========================
    public function keluar()
    {
        $user = auth()->user();

        $presensi = Presensi::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->first();

        if (!$presensi) {
            return back()->with('error', 'Belum presensi masuk');
        }

        if (!$presensi->jam_masuk) {
            return back()->with('error', 'Anda belum absen masuk');
        }

        if ($presensi->jam_keluar) {
            return back()->with('error', 'Sudah presensi keluar');
        }

        $presensi->update([
            'jam_keluar' => now()
        ]);

        return back()->with('success', 'Berhasil presensi keluar');
    }

    // ======================
// HISTORY
// ======================
public function history()
{
    $presensis = Presensi::where('user_id', auth()->id())
        ->get()
        ->keyBy(fn($item) => Carbon::parse($item->tanggal)->format('Y-m-d'));

    // Gabungkan CUTI yang sudah disetujui agar tampil di histori/kalender
    $cutis = Cuti::where('user_id', auth()->id())
        ->where('status', 'disetujui')
        ->get();

    foreach ($cutis as $cuti) {
        $start = Carbon::parse($cuti->tanggal_mulai)->startOfDay();
        $end = Carbon::parse($cuti->tanggal_selesai)->startOfDay();

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $key = $date->format('Y-m-d');

            // Jika pada hari itu sudah ada presensi, jangan timpa status presensi.
            if ($presensis->has($key)) {
                continue;
            }

            $presensis->put($key, (object) [
                'tanggal' => $key,
                'jam_masuk' => null,
                'jam_keluar' => null,
                'status' => 'cuti',
                'izin_status' => null,
                'keterangan' => $cuti->alasan,
            ]);
        }
    }

    // view dipakai untuk tampilan kalender
    return view('presensi.kalender', compact('presensis'));
}

// ======================
// KALENDER
// ======================
public function kalender()
{
    // Reuse logic history supaya /kalender juga menampilkan cuti.
    return $this->history();
}

    // =========================
    // HITUNG JARAK
    // =========================
    private function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) *
            cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

            // =========================
        // HALAMAN PENGATURAN
        // =========================
        public function pengaturan()
{
    $user = auth()->user();
    $school = \App\Models\School::find($user->school_id);

    return view('pengaturan', compact('user', 'school'));
}

        public function settings()
        {
            $school = School::first();

            return view('guru.settings', compact('school'));
        }

        // =========================
        // UPDATE PROFIL
        // =========================
        public function updateProfil(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'nullable|email',
        'password' => 'nullable|min:6',
        'current_password' => 'nullable',
    ], [
        'name.required' => 'Nama lengkap wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.min' => 'Password minimal 6 karakter.',
    ]);

    $user = auth()->user();

    // Update nama
    if ($request->name) {
        $user->name = $request->name;
    }

    // Update email hanya jika dikirim
    if ($request->email) {
        $user->email = $request->email;
    }

    // NOTE: update password dipindahkan ke route khusus /pengaturan/password
    // (supaya validasi tidak terganggu ketika form password mengirim field yang berbeda)

    // Upload foto
    if ($request->hasFile('photo')) {
        if ($user->photo && \Storage::disk('public')->exists($user->photo)) {
            \Storage::disk('public')->delete($user->photo);
        }
        $user->photo = $request->file('photo')->store('profile', 'public');
    }

    $user->save();

    return back()->with('success', 'Profil berhasil diperbarui');
}

        // =========================
        // UPDATE PASSWORD (khusus)
        // =========================
        public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'string', 'min:8'],
    ], [
        'current_password.required' => 'Password saat ini wajib diisi.',
        'current_password.current_password' => 'Password saat ini yang Anda masukkan salah.',
        'password.required' => 'Password baru wajib diisi.',
        'password.min' => 'Password baru minimal harus 8 karakter.',
    ]);

    $user = $request->user();
    $user->password = bcrypt($request->password);
    $user->save();

    return back()->with('success', 'Password berhasil diupdate');
}
        

        public function izinForm()
{
    $izins = \App\Models\Pengajuan::where('user_id', auth()->id())
                ->whereIn('jenis', ['izin', 'sakit', 'acara'])
                ->latest()
                ->get();
    return view('user.izin.form', compact('izins'));
}

public function izinCreate()
{
    return view('user.izin.create');
}

public function izinStore(Request $request)
{
    $request->validate([
        'status'          => 'required|string',
        'tanggal_mulai'   => 'nullable|date|after_or_equal:today',
        'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        'keterangan'      => 'nullable|string|max:1000',
    ]);

    $user    = auth()->user();
    $raw     = strtolower(trim((string) $request->input('status')));
    $jenis   = in_array($raw, ['izin', 'sakit']) ? $raw : 'izin';
    $tanggal = $request->input('tanggal_mulai') ?: today()->toDateString();

    // Cegah duplikat
    $existing = \App\Models\Pengajuan::where('user_id', $user->id)
        ->where('tanggal_mulai', $tanggal)
        ->whereIn('jenis', ['izin', 'sakit'])
        ->whereIn('status', ['pending', 'disetujui'])
        ->first();

    if ($existing) {
        return back()->with('error', 'Anda sudah memiliki pengajuan izin untuk tanggal tersebut.');
    }

    // ✅ Simpan ke pengajuans dengan kolom yang benar
    \App\Models\Pengajuan::create([
        'user_id'         => $user->id,
        'jenis'           => $jenis,
        'tanggal_mulai'   => $tanggal,
        'tanggal_selesai' => $request->input('tanggal_selesai') ?: $tanggal,
        'keterangan'      => $request->input('keterangan'),
        'status'          => 'pending',
    ]);

    return back()->with('success', 'Izin berhasil dikirim, menunggu persetujuan admin.');
}
public function izinIndex()
{
    $izins = \App\Models\Pengajuan::where('user_id', auth()->id())
                ->whereIn('jenis', ['izin', 'sakit'])
                ->orderBy('created_at', 'desc')
                ->get();

    $totalIzin = $izins->count();
    $disetujui = $izins->where('status', 'disetujui')->count();
    $menunggu  = $izins->whereIn('status', ['menunggu', 'pending'])->count();

    return view('user.izin.index', compact('izins', 'totalIzin', 'disetujui', 'menunggu'));
}

public function izinDestroy($id)
{
    $izin = \App\Models\Pengajuan::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
    $izin->delete();

    return redirect()->route('izin.riwayat')->with('success', 'Pengajuan dibatalkan.');
}
}