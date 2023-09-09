<?php

namespace App\Interfaces;

use App\Models\Complaint\Kesepakatan;
use App\Models\Complaint\Mediasi;
use App\Models\Complaint\Musyawarah;
use App\Models\Complaint\Pengaduan;
use App\Models\User;

interface NotifikasiServiceInterface
{
    public function pengaduanCreated(Pengaduan $pengaduan);
    public function pengaduanApproved(Pengaduan $pengaduan);
    public function pengaduanRejected(Pengaduan $pengaduan);
    public function pengaduanCancelled(Pengaduan $pengaduan);
    public function pengaduanClosed(Pengaduan $pengaduan);
    public function musyawarahCreated(Musyawarah $musyawarah);
    public function mediasiCreated(Mediasi $mediasi);
    public function kesepakatanCreated(Kesepakatan $kesepakatan);
    public function kesepakatanDestroyed(Pengaduan $pengaduan);
}
