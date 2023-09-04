<?php
use App\Http\Controllers\NotifikasiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::patch('/notifikasi/{notifikasi}', [NotifikasiController::class, 'update'])->name('notifikasi.update');
});
