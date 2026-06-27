<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class School extends Model
{
    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'akreditasi',
        'kota',
        'logo',
        'deskripsi',
        'latitude',
        'longitude',
        'radius',
        'kode_sekolah',
        'alamat',
        'no_telepon',
        'kepala_sekolah',
    ];

     // 1 sekolah punya 1 admin
    public function admin(): HasOne
    {
        return $this->hasOne(User::class)
                    ->where('role', 'admin');
    }

    // 1 sekolah punya banyak guru
    public function gurus(): HasMany
    {
        return $this->hasMany(User::class)
                    ->where('role', 'guru');
    }

    // Semua user milik sekolah (admin + guru)
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}