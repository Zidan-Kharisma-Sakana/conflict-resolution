<?php
use App\Http\Controllers\MusyawarahController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/musyawarah', [MusyawarahController::class, 'index'])->name('musyawarah.index');
    Route::post('/musyawarah/{pengaduan}', [MusyawarahController::class, 'store'])->name('musyawarah.store');
    Route::get('/musyawarah/{musyawarah}', [MusyawarahController::class, 'show'])->name('musyawarah.show');
    Route::patch('/musyawarah/{musyawarah}', [MusyawarahController::class, 'update'])->name('musyawarah.update');
    Route::delete('/musyawarah/{musyawarah}', [MusyawarahController::class, 'destroy'])->name('musyawarah.destroy');
});
