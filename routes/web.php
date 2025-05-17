<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriPemasukanController;
use App\Http\Controllers\KategoriPengeluaranController;
use App\Http\Controllers\PemasukanController;
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
    Route::group(['prefix' => 'kategori-pengeluaran'], function () {
        Route::get('/', [KategoriPengeluaranController::class, 'index'])->name('kategori_pengeluarans');
        Route::post('/store-kategori', [KategoriPengeluaranController::class, 'store'])->name('store-kategori_pengeluaran');
        Route::delete('/delete-kategori/{id}', [KategoriPengeluaranController::class, 'destroy'])->name('delete-kategori_pengeluaran');
        Route::put('/edit-kategori/{id}', [KategoriPengeluaranController::class, 'edit'])->name('edit-kategori_pengeluaran');
    });

    Route::group(['prefix' => 'pengeluaran'], function () {
        Route::get('/', [PengeluaranController::class, 'index'])->name('pengeluarans');
        Route::post('/store-pengeluaran', [PengeluaranController::class, 'store'])->name('store-pengeluaran');
        Route::delete('/delete-pengeluaran/{id}', [PengeluaranController::class, 'destroy'])->name('delete-pengeluaran');
        Route::put('/edit-pengeluaran/{id}', [PengeluaranController::class, 'edit'])->name('edit-pengeluaran');
    });

    Route::group(['prefix' => 'kategori-pemasukan'], function () {
        Route::get('/', [KategoriPemasukanController::class, 'index'])->name('kategori_pemasukans');
        Route::post('/store-kategori', [KategoriPemasukanController::class, 'store'])->name('store-kategori_pemasukan');
        Route::delete('/delete-kategori/{id}', [KategoriPemasukanController::class, 'destroy'])->name('delete-kategori_pemasukan');
        Route::put('/edit-kategori/{id}', [KategoriPemasukanController::class, 'edit'])->name('edit-kategori_pemasukan');
    });

    Route::group(['prefix' => 'pemasukan'], function () {
        Route::get('/', [PemasukanController::class, 'index'])->name('pemasukans');
        Route::post('/store-pemasukan', [PemasukanController::class, 'store'])->name('store-pemasukan');
        Route::delete('/delete-pemasukan/{id}', [PemasukanController::class, 'destroy'])->name('delete-pemasukan');
        Route::put('/edit-pemasukan/{id}', [PemasukanController::class, 'edit'])->name('edit-pemasukan');
    });
});
