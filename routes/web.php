<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RekapController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\CutiController;
use App\Http\Controllers\Admin\IzinController as AdminIzinController;
use App\Http\Controllers\Admin\SchoolController; // ← TAMBAHAN

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| GURU — presensi, izin, cuti, profil
|--------------------------------------------------------------------------
*/
Route::get('/izin/riwayat', [PresensiController::class, 'izinIndex'])->name('izin.riwayat');
Route::delete('/izin/{id}', [PresensiController::class, 'izinDestroy'])->name('izin.destroy');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [PresensiController::class, 'index'])->name('dashboard');
    Route::post('/masuk', [PresensiController::class, 'masuk'])->name('presensi.masuk');
    Route::post('/keluar', [PresensiController::class, 'keluar'])->name('presensi.keluar');
    Route::get('/history', [PresensiController::class, 'history'])->name('history');
    Route::get('/kalender', [PresensiController::class, 'kalender'])->name('kalender');

    Route::get('/izin/create', [PresensiController::class, 'izinCreate'])->name('izin.create');
    Route::get('/izin', [PresensiController::class, 'izinForm'])->name('izin.form');
    Route::post('/izin', [PresensiController::class, 'izinStore'])->name('izin.store');

    Route::get('/cuti', [CutiController::class, 'index'])->name('cuti.index');
    Route::get('/cuti/create', [CutiController::class, 'create'])->name('cuti.create');
    Route::post('/cuti', [CutiController::class, 'store'])->name('cuti.store');

    Route::get('/pengaturan', [PresensiController::class, 'pengaturan'])->name('pengaturan');
    Route::post('/pengaturan/update', [PresensiController::class, 'updateProfil'])->name('pengaturan.update');

    Route::get('/profil', [ProfileController::class, 'edit'])->name('profil');
    Route::patch('/profil/update', [ProfileController::class, 'update'])->name('profil.update');
    Route::post('/profil/password', [ProfileController::class, 'updatePassword'])->name('profil.password');
    Route::delete('/profil/delete', [ProfileController::class, 'destroy'])->name('profil.delete');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin', 'scope.school'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/profil', [ProfileController::class, 'edit'])->name('admin.profil');
    Route::patch('/admin/profil/update', [ProfileController::class, 'update'])->name('admin.profil.update');

    Route::get('/admin/rekap', [RekapController::class, 'index'])->name('admin.rekap');
    Route::get('/admin/rekap/export', [RekapController::class, 'export'])->name('admin.rekap.export');

    Route::prefix('admin')->group(function () {
        Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
        Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
        Route::post('/guru/store', [GuruController::class, 'store'])->name('guru.store');
        Route::post('/guru/import', [GuruController::class, 'import'])->name('guru.import');
        Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
        Route::put('/guru/{id}', [GuruController::class, 'update'])->name('guru.update');
        Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');
    });

    Route::get('/admin/izin', [AdminIzinController::class, 'index'])->name('izin.index');
    Route::post('/admin/izin/{id}/setujui', [AdminIzinController::class, 'approve'])->name('izin.setujui');
    Route::post('/admin/izin/{id}/tolak', [AdminIzinController::class, 'reject'])->name('izin.tolak');

    Route::post('/admin/cuti/{id}/setujui', [CutiController::class, 'approve'])->name('cuti.setujui');
    Route::post('/admin/cuti/{id}/tolak', [CutiController::class, 'reject'])->name('cuti.tolak');
    Route::get('/admin/cuti', [CutiController::class, 'adminIndex'])->name('admin.cuti.index');

    Route::get('/admin/pengaturan', function () {
        $school = \App\Models\School::find(auth()->user()->school_id);
        return view('admin.pengaturan', compact('school'));
    })->name('admin.pengaturan');

    Route::get('/admin/registrasi', function () {
        $schoolId = auth()->user()->school_id;
        $pendingGuru = User::where('role', 'guru')
                           ->where('school_id', $schoolId)
                           ->get();
        $school  = School::find($schoolId);
        $schools = School::all();
        return view('admin.registrasi', compact('pendingGuru', 'school', 'schools'));
    })->name('admin.registrasi');
});


Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
 
    // Resource route otomatis mendaftarkan GET/POST/PUT/DELETE
    // Ini yang mencegah error "PUT method not supported"
    Route::resource('guru', GuruController::class)
         ->except(['show']);
 
    // Route import Excel (di luar resource)
    Route::post('guru/import', [GuruController::class, 'import'])
         ->name('guru.import');
});
 

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'superadmin'])->group(function () {

    Route::get('/superadmin/dashboard', function () {
        return view('superadmin.beranda');
    })->name('superadmin.dashboard');

    // SEKOLAH ← diganti pakai SchoolController
    Route::get('/admin/schools', [SchoolController::class, 'index'])->name('superadmin.schools');
    Route::get('/admin/schools/create', [SchoolController::class, 'create'])->name('superadmin.schools.create');
    Route::post('/admin/schools', [SchoolController::class, 'store'])->name('superadmin.schools.store');
    Route::get('/admin/schools/{id}/edit', [SchoolController::class, 'edit'])->name('superadmin.schools.edit');
    Route::put('/admin/schools/{id}', [SchoolController::class, 'update'])->name('superadmin.schools.update');
    Route::delete('/admin/schools/{id}', [SchoolController::class, 'destroy'])->name('superadmin.schools.delete');

    // KELOLA AKUN
    Route::get('/superadmin/users', function () {
        $users   = User::with('school')->get();
        $schools = School::all();
        return view('admin.users', compact('users', 'schools'));
    })->name('admin.users');

    Route::patch('/superadmin/users/{id}/assign-school', function (Request $request, $id) {
        $request->validate([
            'school_id' => 'required|exists:schools,id',
        ]);
        $user = User::findOrFail($id);
        $sudahAdaAdmin = User::where('role', 'admin')
                             ->where('school_id', $request->school_id)
                             ->where('id', '!=', $id)
                             ->exists();
        if ($sudahAdaAdmin) {
            return back()->withErrors(['school_id' => 'Sekolah ini sudah punya admin.']);
        }
        $user->update(['school_id' => $request->school_id]);
        return back()->with('success', 'Admin berhasil dikaitkan ke sekolah.');
    })->name('admin.users.assignSchool');

    Route::put('/superadmin/users/{id}/edit', function (Request $request, $id) {
        User::where('id', $id)->update([
            'role'      => $request->role,
            'school_id' => $request->school_id ?: null,
        ]);
        $user = User::find($id);
        return back()->with('success', 'Akun ' . $user->name . ' berhasil diperbarui');
    })->name('admin.users.edit');

    Route::post('/superadmin/users/{id}/make-guru', function ($id) {
        $user = User::findOrFail($id);
        $user->role = 'guru';
        $user->save();
        return back()->with('success', $user->name . ' berhasil dijadikan Guru');
    })->name('admin.users.makeGuru');

    Route::post('/superadmin/users/{id}/make-admin', function ($id) {
        $user = User::findOrFail($id);
        $user->role = 'admin';
        $user->save();
        return back()->with('success', 'User berhasil jadi admin');
    })->name('admin.users.makeAdmin');

    Route::delete('/superadmin/users/{id}', function ($id) {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User berhasil dihapus');
    })->name('admin.users.delete');
});

/*
|--------------------------------------------------------------------------
| PROFILE (DEFAULT BREEZE)
|--------------------------------------------------------------------------
*/
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';