<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Complaint\Kesepakatan;
use App\Models\Complaint\Mediasi;
use App\Models\Complaint\Musyawarah;
use App\Models\Complaint\Pengaduan;
use App\Models\Profile\Bappebti;
use App\Models\Profile\Bursa;
use App\Models\Profile\Nasabah;
use App\Models\Profile\Pialang;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pialang(): HasOne
    {
        return $this->hasOne(Pialang::class);
    }

    public function bappebti(): HasOne
    {
        return $this->hasOne(Bappebti::class);
    }

    public function nasabah(): HasOne
    {
        return $this->hasOne(Nasabah::class);
    }

    public function bursa(): HasOne
    {
        return $this->hasOne(Bursa::class);
    }

    public function kesepakatans(): HasMany
    {
        return $this->hasMany(Kesepakatan::class);
    }
    public function notifikasis(): HasMany
    {
        return $this->hasMany(Notifikasi::class);
    }

    public const IS_NASABAH = 'nasabah';
    public const IS_PIALANG = 'pialang';
    public const IS_BURSA = 'bursa';
    public const IS_BAPPEBTI = 'bappebti';

    public function getRelatedPengaduans(): Collection
    {
        switch ($this->role) {
            case $this::IS_BAPPEBTI:
                return Pengaduan::with(["nasabah", "pialang", "bursa"])
                    ->orderBy('waktu_dibuat', 'desc')->get();
            case $this::IS_PIALANG:
                return Pengaduan::where('pialang_id', (int) $this->pialang->id)
                    ->orderBy('waktu_dibuat', 'desc')
                    ->with(["nasabah", "pialang", "bursa"])->get();
            case $this::IS_BURSA:
                return Pengaduan::where('bursa_id', (int) $this->bursa->id)
                    ->orderBy('waktu_dibuat', 'desc')
                    ->with(["nasabah", "pialang", "bursa"])->get();
            case $this::IS_NASABAH:
                return Pengaduan::where('nasabah_id', (int) $this->nasabah->id)
                    ->orderBy('waktu_dibuat', 'desc')
                    ->with(["nasabah", "pialang", "bursa"])->get();
        }
        return collect([]);
    }

    public function getRelatedMusyawarahs()
    {
        switch ($this->role) {
            case $this::IS_BAPPEBTI:
                return Musyawarah::with("pengaduan")->orderBy('tanggal_waktu', 'desc')->get();
            case $this::IS_PIALANG:
                $pengaduanId = $this->pialang->pengaduans->map(fn ($pengaduan) => $pengaduan->id);
                return Musyawarah::whereIn('pengaduan_id', $pengaduanId)
                    ->with(["pengaduan"])
                    ->orderBy('tanggal_waktu', 'desc')->get();

            case $this::IS_BURSA:
                $pengaduanId = $this->bursa->pengaduans->map(fn ($pengaduan) => $pengaduan->id);
                return Musyawarah::whereIn('pengaduan_id', $pengaduanId)
                    ->with(["pengaduan"])
                    ->orderBy('tanggal_waktu', 'desc')->get();

            case $this::IS_NASABAH:
                $pengaduanId = $this->nasabah->pengaduans->map(fn ($pengaduan) => $pengaduan->id);
                return Musyawarah::whereIn('pengaduan_id', $pengaduanId)
                    ->with(["pengaduan"])
                    ->orderBy('tanggal_waktu', 'desc')->get();
        }
        return collect([]);
    }

    public function getRelatedMediasis()
    {
        switch ($this->role) {
            case $this::IS_BAPPEBTI:
                return Mediasi::with("pengaduan")->orderBy('tanggal_waktu', 'desc')->get();
            case $this::IS_PIALANG:
                $pengaduanId = $this->pialang->pengaduans->map(fn ($pengaduan) => $pengaduan->id);
                return Mediasi::whereIn('pengaduan_id', $pengaduanId)
                    ->with(["pengaduan"])
                    ->orderBy('tanggal_waktu', 'desc')->get();

            case $this::IS_BURSA:
                $pengaduanId = $this->bursa->pengaduans->map(fn ($pengaduan) => $pengaduan->id);
                return Mediasi::whereIn('pengaduan_id', $pengaduanId)
                    ->with(["pengaduan"])
                    ->orderBy('tanggal_waktu', 'desc')->get();

            case $this::IS_NASABAH:
                $pengaduanId = $this->nasabah->pengaduans->map(fn ($pengaduan) => $pengaduan->id);
                return Mediasi::whereIn('pengaduan_id', $pengaduanId)
                    ->with(["pengaduan"])
                    ->orderBy('tanggal_waktu', 'desc')->get();
        }
        return collect([]);
    }
    public function  countNewNotification(): int
    {
        return Notifikasi::where('user_id', $this->id)->where('is_seen', 0)->count();
    }
}
