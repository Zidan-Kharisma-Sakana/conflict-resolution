<?php

namespace App\Services;

use App\Interfaces\NotificationServiceInterface;
use App\Models\Complaint\Kesepakatan;
use App\Models\Complaint\Mediasi;
use App\Models\Complaint\Musyawarah;
use App\Models\Complaint\Pengaduan;
use Carbon\Carbon;

class NotificationService implements NotificationServiceInterface
{
    public function pengaduanCreated(Pengaduan $pengaduan)
    {
        // notify bappebti
        $subject = "Pengaduan Baru";
        $content = "Pengaduan Baru dari nasabah " . $pengaduan->nasabah->user->name .
            ' untuk pialang ' . $pengaduan->pialang->user->name;
    }
    public function pengaduanApproved(Pengaduan $pengaduan)
    {
        // notify pialang & nasabah
        $subject = "Disposisi Pengaduan ke Pialang " . $pengaduan->pialang->user->name;
        $content = "BAPPEBTI mendisposisikan pialang " . $pengaduan->pialang->user->name .
            " untuk menyelesaikan pengaduan hingga " . Carbon::parse($pengaduan->waktu_expires_pialang)->isoFormat('dddd, D MMMM Y');
    }
    public function pengaduanRejected(Pengaduan $pengaduan)
    {
        // notify nasabah
        $subject = "Pengaduan Anda Ditolak oleh BAPPEBTI";
        $content = "BAPPEBTI menolak pengaduan anda dengan alasan: " . $pengaduan->alasan_penolakan;
    }
    public function pengaduanCancelled(Pengaduan $pengaduan)
    {
        // notify pialang & nasabah & bursa
        $subject = "Pengaduan Dibatalkan";
        $content = "BAPPEBTI membatalkan pengaduan dengan ID " . $pengaduan->id;
    }
    public function pengaduanClosed(Pengaduan $pengaduan)
    {
        // notify pialang & nasabah & bursa
        $subject = "Pengaduan Ditutup";
        $content = "BAPPEBTI telah mengonfirmasi kesepakatan sehingga pengaduan akan ditutup";
    }
    public function musyawarahCreated(Musyawarah $musyawarah)
    {
        // notify pialang & nasabah
        $subject = "Musyawarah Baru Dijadwalkan";
        $content = "Pialang " . $musyawarah->pengaduan->pialang->user->name .
        " menjadwalkan musyawarah pada " . Carbon::parse($musyawarah->tanggal_waktu)->isoFormat('dddd, D MMMM Y');
    }
    public function mediasiCreated(Mediasi $mediasi)
    {
        // notify pialang & nasabah & mediasi
        $subject = "Mediasi Baru Dijadwalkan";
        $content = "Bursa " . $mediasi->pengaduan->pialang->user->name .
        " menjadwalkan mediasi pada " . Carbon::parse($mediasi->tanggal_waktu)->isoFormat('dddd, D MMMM Y');
    }
    public function kesepakatanCreated(Kesepakatan $kesepakatan)
    {
        // notify bappebti
        $subject = "Kesepakatan Baru Dibuat";
        $content = "Kesepakatan untuk pengaduan dengan ID " . $kesepakatan->pengaduan_id . " dibuat oleh pihak " . $kesepakatan->user->name;
    }
}
