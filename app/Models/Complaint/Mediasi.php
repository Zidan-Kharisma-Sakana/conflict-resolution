<?php

namespace App\Models\Complaint;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mediasi extends Model
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
        $time  = Carbon::parse($this->tanggal_waktu);
        if($this->hasil == $this::HASIL_BATAL){
            return "Dibatalkan";
        }
        if($time->isPast() && !empty($this->hasil)){
            return "Selesai";
        }
        if($time->isPast()){
            return "Hasil Belum Diisi";
        }
        return "Belum Dimulai";
    }
    public const HASIL_BATAL = "BATAL";
    public const HASIL_SEPAKAT = "SEPAKAT";
    public const HASIL_BELUM_SEPAKAT = "BELUM SEPAKAT";
    public const HASIL_RESCHEDULE = "RESCHEDULE";
}
