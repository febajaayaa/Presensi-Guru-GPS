<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    protected $table = 'profil_sekolah';

    protected $fillable = [
        'nama_sekolah',
        'alamat',
        'telepon',
        'email',
        'kepala_sekolah',
        'logo',
        'deskripsi'
    ];
}