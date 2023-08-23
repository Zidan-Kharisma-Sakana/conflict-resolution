<?php

namespace App\Providers;

use App\Interfaces\AuthServiceInterface;
use App\Interfaces\MediasiServiceInterface;
use App\Interfaces\MusyawarahServiceInterface;
use App\Interfaces\PengaduanServiceInterface;
use App\Services\AuthService;
use App\Services\KesepakatanService;
use App\Services\MediasiService;
use App\Services\MusyawarahService;
use App\Services\PengaduanService;
use Carbon\Carbon;
use DebugBar\DebugBar;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(PengaduanServiceInterface::class, PengaduanService::class);
        $this->app->bind(MusyawarahServiceInterface::class, MusyawarahService::class);
        $this->app->bind(MediasiServiceInterface::class, MediasiService::class);
        $this->app->bind(KesepakatanServiceInterface::class, KesepakatanService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Carbon::setLocale(config('app.locale'));

    }
}
