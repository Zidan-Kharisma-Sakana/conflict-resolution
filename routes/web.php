<?php

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
    Route::patch('/account/nasabah', [NasabahController::class, 'update'])->name('nasabah.update');
    Route::patch('/account/pialang', [PialangController::class, 'update'])->name('pialang.update');
    Route::patch('/account/bursa', [BursaController::class, 'update'])->name('bursa.update');
    Route::patch('/account/bappebti', [BappebtiController::class, 'update'])->name('bappebti.update');
});

require __DIR__.'/auth.php';
