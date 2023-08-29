<?php

namespace App\Console;

use App\Models\Complaint\Pengaduan;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use function Laravel\Prompts\error;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $pengaduans = Pengaduan::where('status', Pengaduan::STATUS_DISPOSISI_PIALANG)
                ->where('waktu_expires_pialang', '<', Carbon::now())
                ->whereNull('waktu_kesepakatan')
                ->update([
                    'status' => Pengaduan::STATUS_DISPOSISI_BURSA,
                    'waktu_expires_bursa' => Carbon::now()->addWeekdays(21)
                ]);
        })->everyThirtySeconds();

        $schedule->call(function () {
            error_log(Carbon::now());
            $pengaduans = Pengaduan::where('status', Pengaduan::STATUS_DISPOSISI_BURSA)
                ->whereNull('waktu_kesepakatan')
                ->where('waktu_expires_bursa', '<', Carbon::now())
                ->update([
                    'status' => Pengaduan::STATUS_DISPOSISI_BURSA_EXPIRED,
                ]);
        })->everyThirtySeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
