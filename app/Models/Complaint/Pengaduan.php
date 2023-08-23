<?php

namespace App\Models\Complaint;

use App\Models\Profile\Bursa;
use App\Models\Profile\Nasabah;
use App\Models\Profile\Pialang;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengaduan extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $casts = [
        'terlapor' => 'array',
        'waktu_dibuat' => 'datetime',
        'waktu_expires_bappebti' => 'datetime',
        'waktu_selesai_bappebti' => 'datetime',
        'waktu_expires_pialang' => 'datetime',
        'waktu_selesai_pialang' => 'datetime',
        'waktu_expires_bursa' => 'datetime',
        'waktu_selesai_bursa' => 'datetime',
        'waktu_selesai_pengecekan' => 'datetime',
        'waktu_kesepakatan' => 'datetime',
        'ada_kesepakatan' => 'boolean'
    ];
    protected $guarded = [];

    public function nasabah(): BelongsTo
    {
        return $this->belongsTo(Nasabah::class);
    }
    public function pialang(): BelongsTo
    {
        return $this->belongsTo(Pialang::class);
    }
    public function bursa(): BelongsTo
    {
        return $this->belongsTo(Bursa::class);
    }
    public function berkasPengaduans(): HasMany
    {
        return $this->hasMany(BerkasPengaduan::class);
    }
    public function pertanyaanPengaduans(): HasMany
    {
        return $this->hasMany(PertanyaanPengaduan::class);
    }
    public function musyawarahs(): HasMany
    {
        return $this->hasMany(Musyawarah::class);
    }
    public function mediasis(): HasMany
    {
        return $this->hasMany(Mediasi::class);
    }
    public function kesepakatan(): HasOne
    {
        return $this->hasOne(Kesepakatan::class);
    }

    public const STATUS_CREATED = 'created';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_DISPOSISI_PIALANG = 'disposisi_pialang';
    public const STATUS_DISPOSISI_BURSA = 'disposisi_bursa';
    public const STATUS_FINISHED = 'finished';
    public const STATUS_CLOSED = 'closed';

}
