<?php
use App\Http\Controllers\MusyawarahController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/musyawarah', [MusyawarahController::class, 'index'])->name('musyawarah.index');
    Route::post('/musyawarah/{id}', [MusyawarahController::class, 'store'])->name('musyawarah.store');
    Route::get('/musyawarah/{id}', [MusyawarahController::class, 'show'])->name('musyawarah.show');
    Route::patch('/musyawarah/{id}', [MusyawarahController::class, 'update'])->name('musyawarah.update');
    Route::delete('/musyawarah/{id}', [MusyawarahController::class, 'destroy'])->name('musyawarah.destroy');
});
