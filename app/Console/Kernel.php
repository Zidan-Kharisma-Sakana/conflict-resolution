<?php

namespace App\Console;

use App\Invokables\EscalateDisposisiBursa;
use App\Invokables\EscalateDisposisiPialang;
use App\Invokables\ThrowDeadlineBursaWarning;
use App\Invokables\ThrowDeadlinePialangWarning;
use App\Models\Complaint\Pengaduan;
use App\Services\NotifikasiService;
use App\Services\ScheduleService;
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
        $schedule->call(new EscalateDisposisiPialang)->everyThirtySeconds();
        $schedule->call(new EscalateDisposisiBursa)->everyThirtySeconds();
        $schedule->call(new ThrowDeadlineBursaWarning)->everyThirtySeconds();
        $schedule->call(new ThrowDeadlinePialangWarning)->everyThirtySeconds();
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
