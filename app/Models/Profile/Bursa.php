<?php

namespace App\Models\Profile;

use App\Models\Complaint\Pengaduan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Bursa extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pialangs(): HasMany
    {
        return $this->hasMany(Pialang::class);
    }
    public function pengaduans(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }
}
