<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Izin extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_izin',
        'tanggal_mulai',
        'keterangan',
        'lampiran',
        'status',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeMenunggu($query)
    {
        return $query->where('status', 'menunggu');
    }

    public function scopeDisetujui($query)
    {
        return $query->where('status', 'disetujui');
    }

    public function isMenunggu(): bool
    {
        return $this->status === 'menunggu';
    }
}