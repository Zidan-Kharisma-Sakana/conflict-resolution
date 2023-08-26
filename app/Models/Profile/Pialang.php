<?php

namespace App\Models\Profile;

use App\Models\Complaint\Pengaduan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pialang extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bursa(): BelongsTo
    {
        return $this->belongsTo(Bursa::class);
    }
    public function pengaduans(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }
}
