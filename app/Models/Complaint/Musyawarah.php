<?php

namespace App\Models\Complaint;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Musyawarah extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];
    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class);
    }
    public function getStatus(){
        $time  = Carbon::parse($this->tanggal_pertemuan);
        if($time->isPast() && !empty($this->hasil)){
            return "Selesai";
        }
        elseif($time->isPast()){
            return "Hasil Belum Diisi";
        }
        return "Belum Dimulai";
    }
}
