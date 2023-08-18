<?php

use App\Http\Controllers\Profile\AccountController;
use App\Http\Controllers\Profile\BappebtiController;
use App\Http\Controllers\Profile\BursaController;
use App\Http\Controllers\Profile\NasabahController;
use App\Http\Controllers\Profile\PialangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::patch('/account/nasabah', [NasabahController::class, 'update'])->name('nasabah.update');
    Route::patch('/account/pialang', [PialangController::class, 'update'])->name('pialang.update');
    Route::patch('/account/bursa', [BursaController::class, 'update'])->name('bursa.update');
    Route::patch('/account/bappebti', [BappebtiController::class, 'update'])->name('bappebti.update');
});
