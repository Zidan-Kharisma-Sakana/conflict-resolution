<?php

namespace App\Services;

use App\Interfaces\DashboardServiceInterface;
use App\Models\Complaint\Pengaduan;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class DashboardService implements DashboardServiceInterface
{
    public function getPengaduanStatsData(Collection $pengaduans)
    {
        $pengaduanNotRejected = $pengaduans->filter(fn ($item) => $item->status != Pengaduan::STATUS_REJECTED);
        $count = [
            'daily' => 0,
            'weekly' => 0,
            'monthly' => 0,
            'total' => $pengaduanNotRejected->count(),
            'total_pialang_late' => 0,
            'total_bursa_late' => 0,
        ];
        foreach ($pengaduanNotRejected as $pengaduan) {
            $created_at = Carbon::parse($pengaduan->waktu_dibuat);
            if ($pengaduan->is_pialang_late) $count['total_pialang_late']++;
            if ($pengaduan->is_bursa_late) $count['total_bursa_late']++;
            if ($created_at > Carbon::now()->startOfDay()) $count['daily']++;
            if ($created_at > Carbon::now()->startOfWeek()) $count['weekly']++;
            if ($created_at > Carbon::now()->startOfMonth()) $count['monthly']++;
        }
        return collect($count);
    }

    public function getYearlyPengaduanData(Collection $pengaduans)
    {
        return [
            'byMonth' => $this->groupYearlyPengaduanByMonth($pengaduans),
            'byStatus' => $this->groupYearlyPengaduanByStatus($pengaduans)
        ];
    }

    public function getActivePengaduanData(Collection $pengaduans)
    {

    }

    private function groupYearlyPengaduanByMonth(Collection $pengaduans)
    {
        $pengaduans = $pengaduans->filter(fn ($item) => $item->status != Pengaduan::STATUS_REJECTED);
        $results = [
            'total' => array_fill(0, 12, 0),
            'pialang_late' => array_fill(0, 12, 0),
            'bursa_late' => array_fill(0, 12, 0),
        ];
        $countsByMonth = $pengaduans->map(function ($pengaduan) {
            return Carbon::parse($pengaduan->waktu_dibuat)->month;
        })->countBy();
        foreach ($countsByMonth as $key => $value) {
            $results['total'][($key - 1)] = $value;
        }
        foreach ($pengaduans as $pengaduan) {
            $index = (Carbon::parse($pengaduan->waktu_dibuat)->month) - 1;
            $results['pialang_late'][$index] += $pengaduan->is_pialang_late ?? 0;
            $results['bursa_late'][$index] += $pengaduan->is_bursa_late ?? 0;
        }
        return collect($results);
    }
    private function groupYearlyPengaduanByStatus(Collection $pengaduans){
        return $pengaduans->countBy(function ($pengaduan) {
            return $pengaduan['status'];
        });
    }
}
