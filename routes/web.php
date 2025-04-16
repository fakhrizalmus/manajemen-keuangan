<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ReportController;
use Illuminate\Routing\RouteGroup;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginIndex'])->name('login-index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'registerIndex'])->name('register-index');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [ReportController::class, 'index'])->name('home');
    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index'])->name('kategoris');
        Route::post('/store-kategori', [KategoriController::class, 'store'])->name('store-kategori');
        Route::delete('/delete-kategori/{id}', [KategoriController::class, 'destroy'])->name('delete-kategori');
        Route::put('/edit-kategori/{id}', [KategoriController::class, 'edit'])->name('edit-kategori');
    });

    Route::group(['prefix' => 'pengeluaran'], function () {
        Route::get('/', [PengeluaranController::class, 'index'])->name('pengeluarans');
        Route::post('/store-pengeluaran', [PengeluaranController::class, 'store'])->name('store-pengeluaran');
        Route::delete('/delete-pengeluaran/{id}', [PengeluaranController::class, 'destroy'])->name('delete-pengeluaran');
        Route::put('/edit-pengeluaran/{id}', [PengeluaranController::class, 'edit'])->name('edit-pengeluaran');
    });
});
