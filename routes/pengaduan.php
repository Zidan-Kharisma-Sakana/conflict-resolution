<?php
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/add', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::patch('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
});
