<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $fillable = [
        'user_id',
        'jenis',          // ✅ kolom asli di DB
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',     // ✅ kolom asli di DB
        'status',
        'approved_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}