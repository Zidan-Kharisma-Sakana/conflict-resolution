<?php
use App\Http\Controllers\KesepakatanController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/kesepakatan/{pengaduan}', [KesepakatanController::class, 'store'])->name('kesepakatan.store');
    Route::patch('/kesepakatan/{kesepakatan}', [KesepakatanController::class, 'update'])->name('kesepakatan.update');
});
