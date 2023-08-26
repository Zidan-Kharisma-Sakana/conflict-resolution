<?php
use App\Http\Controllers\KesepakatanController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/kesepakatan/{id}', [KesepakatanController::class, 'store'])->name('kesepakatan.store');
    Route::patch('/kesepakatan/{id}', [KesepakatanController::class, 'update'])->name('kesepakatan.update');
});
