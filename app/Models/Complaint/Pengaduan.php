<?php

namespace App\Models\Complaint;

use App\Models\Profile\Bursa;
use App\Models\Profile\Nasabah;
use App\Models\Profile\Pialang;
use App\Models\User;
use Carbon\Carbon;
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
        'waktu_expires_pialang' => 'datetime',
        'waktu_expires_bursa' => 'datetime',
        'waktu_selesai' => 'datetime',
        'waktu_kesepakatan' => 'datetime',
        'ada_kesepakatan' => 'boolean'
    ];
    protected $guarded = [];

    public function nasabah(): BelongsTo
    {
        return $this->belongsTo(Nasabah::class)->with("user");
    }
    public function pialang(): BelongsTo
    {
        return $this->belongsTo(Pialang::class)->with("user");
    }
    public function bursa(): BelongsTo
    {
        return $this->belongsTo(Bursa::class)->with("user");
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
    public const STATUS_DISPOSISI_BURSA_EXPIRED = 'disposisi_bursa_expired';
    public const STATUS_FINISHED = 'finished';
    public const STATUS_CLOSED = 'closed';
    public const STATUS_MEANING = [
        'created' => "Menunggu Pengecekan Bappebti",
        'rejected' => "Berkas Pengaduan Ditolak Bappebti",
        'disposisi_pialang' => "Diproses Pialang",
        'disposisi_bursa' => "Diproses Bursa",
        'disposisi_bursa_expired' => 'Bursa Terlambat',
        'finished' => "Kesepakatan Sudah Dibuat",
        'closed' => "Pengaduan Ditutup",
    ];

    public function getStatusMeaning()
    {
        return $this::STATUS_MEANING[$this->status];
    }
    public function getDeadline()
    {
        switch ($this->status) {
            case $this::STATUS_CREATED:
                return 'Verifikasi oleh Bappebti hingga ' . Carbon::parse($this->waktu_expires_bappebti)->isoFormat('dddd, D MMMM Y');
            case $this::STATUS_DISPOSISI_PIALANG:
                return 'Pialang Mengupayakan Kesepakatan hingga ' . Carbon::parse($this->waktu_expires_pialang)->isoFormat('dddd, D MMMM Y');
            case $this::STATUS_DISPOSISI_BURSA:
                return 'Bursa Mengupayakan Kesepakatan hingga ' . Carbon::parse($this->waktu_expires_bursa)->isoFormat('dddd, D MMMM Y');
            case $this::STATUS_DISPOSISI_BURSA_EXPIRED:
                return 'Bursa Terlambat Mengupayakan Kesepakatan';
            default:
                return '-';
        }
    }
    public function getDeadlineDate()
    {
        switch ($this->status) {
            case $this::STATUS_CREATED:
                return  Carbon::parse($this->waktu_expires_bappebti)->isoFormat('dddd, D MMMM Y');
            case $this::STATUS_DISPOSISI_PIALANG:
                return Carbon::parse($this->waktu_expires_pialang)->isoFormat('dddd, D MMMM Y');
            case $this::STATUS_DISPOSISI_BURSA:
                return  Carbon::parse($this->waktu_expires_bursa)->isoFormat('dddd, D MMMM Y');
            case $this::STATUS_DISPOSISI_BURSA_EXPIRED:
                return  Carbon::parse($this->waktu_expires_bursa)->isoFormat('dddd, D MMMM Y');
            default:
                return '-';
        }
    }
    public function isOpen()
    {
        return empty($this->force_close_time) && in_array($this->status, array($this::STATUS_DISPOSISI_PIALANG, $this::STATUS_DISPOSISI_BURSA, $this::STATUS_DISPOSISI_BURSA_EXPIRED, $this::STATUS_CREATED));
    }
}
