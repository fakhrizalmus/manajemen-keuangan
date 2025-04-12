<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengeluaranController;
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

Route::get('/', [PengeluaranController::class, 'index']);
Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index'])->name('kategoris');
    Route::get('/add-kategori', [KategoriController::class, 'create'])->name('add-kategori');
    Route::post('/store-kategori', [KategoriController::class, 'store'])->name('store-kategori');
    Route::delete('/delete-kategori/{id}', [KategoriController::class, 'destroy'])->name('delete-kategori');
});
