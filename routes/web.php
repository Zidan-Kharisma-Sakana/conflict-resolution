<?php

use App\Http\Controllers\KesepakatanController;
use App\Http\Controllers\MediasiController;
use App\Http\Controllers\MusyawarahController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Profile\AccountController;
use App\Http\Controllers\Profile\BappebtiController;
use App\Http\Controllers\Profile\BursaController;
use App\Http\Controllers\Profile\NasabahController;
use App\Http\Controllers\Profile\PialangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');


    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/add', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::patch('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');

    Route::get('/musyawarah', [MusyawarahController::class, 'index'])->name('musyawarah.index');
    Route::post('/musyawarah/{id}', [MusyawarahController::class, 'store'])->name('musyawarah.store');
    Route::get('/musyawarah/{id}', [MusyawarahController::class, 'show'])->name('musyawarah.show');
    Route::patch('/musyawarah/{id}', [MusyawarahController::class, 'update'])->name('musyawarah.update');
    Route::delete('/musyawarah/{id}', [MusyawarahController::class, 'destroy'])->name('musyawarah.destroy');

    Route::get('/mediasi', [MediasiController::class, 'index'])->name('mediasi.index');
    Route::post('/mediasi/{id}', [MediasiController::class, 'store'])->name('mediasi.store');
    Route::get('/mediasi/{id}', [MediasiController::class, 'show'])->name('mediasi.show');
    Route::patch('/mediasi/{id}', [MediasiController::class, 'update'])->name('mediasi.update');
    Route::delete('/mediasi/{id}', [MediasiController::class, 'destroy'])->name('mediasi.destroy');

    Route::post('/kesepakatan/{id}', [KesepakatanController::class, 'store'])->name('kesepakatan.store');
    Route::patch('/kesepakatan/{id}', [KesepakatanController::class, 'update'])->name('kesepakatan.update');

});


require __DIR__ . '/account.php';
require __DIR__ . '/auth.php';
