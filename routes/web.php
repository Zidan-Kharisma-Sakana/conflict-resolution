<?php

use App\Http\Controllers\Profile\AccountController;
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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AccountController::class, 'dashboard'])->name('dashboard');
    Route::get('/excel', [AccountController::class, 'excel'])->name('excel');
    Route::get('/account/me', [AccountController::class, 'edit'])->name('account.edit');
    Route::patch('/account/me', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account/me', [AccountController::class, 'destroy'])->name('account.destroy');

    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::get('/account/{user}', [AccountController::class, 'show'])->name('account.show');
    Route::delete('/account/{user}', [AccountController::class, 'delete'])->name('account.delete');
});


require __DIR__ . '/account.php';
require __DIR__ . '/pengaduan.php';
require __DIR__ . '/musyawarah.php';
require __DIR__ . '/mediasi.php';
require __DIR__ . '/kesepakatan.php';
require __DIR__ . '/notifikasi.php';

require __DIR__ . '/auth.php';
