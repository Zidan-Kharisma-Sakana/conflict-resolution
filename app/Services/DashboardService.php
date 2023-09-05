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
    public function getDashboardData(User $user)
    {
        $pengaduans = $user->getRelatedPengaduans();
        $pengaduanCount = $this->findPengaduanCount($pengaduans);
        $pengaduanStats = $pengaduans->countBy(function ($pengaduan) {
            return $pengaduan['status'];
        });
        $pengaduanTrend = $user->role != User::IS_NASABAH ? $this->findPengaduanTrends($pengaduans) : null;
        return [
            'pengaduanCount' => $pengaduanCount,
            'pengaduanStats' => $pengaduanStats,
            'pengaduanTrend' => $pengaduanTrend
        ];
    }
    private function findPengaduanCount(Collection $pengaduans)
    {
        $count = [
            'daily' => 0,
            'weekly' => 0,
            'monthly' => 0,
            'allTime' => $pengaduans->count(),
        ];
        foreach ($pengaduans as $pengaduan) {
            $created_at = Carbon::parse($pengaduan->waktu_dibuat);
            if ($created_at > Carbon::now()->startOfDay()) $count['daily']++;
            if ($created_at > Carbon::now()->startOfWeek()) $count['weekly']++;
            if ($created_at > Carbon::now()->startOfMonth()) $count['monthly']++;
        }
        // dd($pengaduans->map(function($item) use ($now){
        //     $created_at = Carbon::parse($item->waktu_dibuat);
        //     return [$now->startOfDay()->isoFormat('dddd, DD-MM-YYYY')
        //     ,  $now->startOfWeek()->isoFormat('dddd, DD-MM-YYYY'),
        //      $now->startOfMonth()->isoFormat('dddd, DD-MM-YYYY'),
        //      $created_at->isoFormat('dddd, DD-MM-YYYY')];
        // }));
        return collect($count);
    }

    private function findPengaduanTrends(Collection $pengaduans)
    {
        $result = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $counts = $pengaduans->map(function ($pengaduan) {
            return Carbon::parse($pengaduan->waktu_dibuat)->month;
        })->countBy();
        foreach($counts as $key=>$value){
            $result[($key-1)] = $value;
        }
        return collect($result);
    }
}
