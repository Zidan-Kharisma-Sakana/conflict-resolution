<?php

namespace App\Models\Complaint;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Musyawarah extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'tanggal_waktu' => 'datetime',
        'waktu_selesai'=>'datetime',
    ];
    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
