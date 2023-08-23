<?php

namespace App\Models\Complaint;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kesepakatan extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
