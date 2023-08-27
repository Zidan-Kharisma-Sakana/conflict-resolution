<?php
use App\Http\Controllers\MediasiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mediasi', [MediasiController::class, 'index'])->name('mediasi.index');
    Route::post('/mediasi/{pengaduan}', [MediasiController::class, 'store'])->name('mediasi.store');
    Route::get('/mediasi/{mediasi}', [MediasiController::class, 'show'])->name('mediasi.show');
    Route::patch('/mediasi/{mediasi}', [MediasiController::class, 'update'])->name('mediasi.update');
    Route::delete('/mediasi/{mediasi}', [MediasiController::class, 'destroy'])->name('mediasi.destroy');
});
