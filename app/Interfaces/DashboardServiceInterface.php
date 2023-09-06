<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface DashboardServiceInterface
{
    public function getPengaduanStatsData(Collection $pengaduans);
    public function getActivePengaduanData(Collection $pengaduans);
    public function getYearlyPengaduanData(Collection $pengaduans);
}
