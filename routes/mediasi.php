<?php
use App\Http\Controllers\MediasiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mediasi', [MediasiController::class, 'index'])->name('mediasi.index');
    Route::post('/mediasi/{id}', [MediasiController::class, 'store'])->name('mediasi.store');
    Route::get('/mediasi/{id}', [MediasiController::class, 'show'])->name('mediasi.show');
    Route::patch('/mediasi/{id}', [MediasiController::class, 'update'])->name('mediasi.update');
    Route::delete('/mediasi/{id}', [MediasiController::class, 'destroy'])->name('mediasi.destroy');
});
