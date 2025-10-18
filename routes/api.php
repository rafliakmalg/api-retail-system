<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use Illuminate\Support\Facades\Route;

Route::prefix('pelanggan')->group(function () {
    Route::get('/', [PelangganController::class, 'index']);
    Route::post('/', [PelangganController::class, 'store']);
    Route::get('/{id}', [PelangganController::class, 'show']);
    Route::put('/{id}', [PelangganController::class, 'update']);
    Route::delete('/{id}', [PelangganController::class, 'destroy']);
});

Route::prefix('barang')->group(function () {
    Route::get('/', [BarangController::class, 'index']);
    Route::post('/', [BarangController::class, 'store']);
    Route::get('/{id}', [BarangController::class, 'show']);
    Route::put('/{id}', [BarangController::class, 'update']);
    Route::delete('/{id}', [BarangController::class, 'destroy']);
});

Route::prefix('penjualan')->group(function () {
    Route::get('/', [PenjualanController::class, 'index']);
        Route::post('/', [PenjualanController::class, 'store']);
    Route::get('/{id}', [PenjualanController::class, 'show']);
    Route::put('/{id}', [PenjualanController::class, 'update']);
    Route::delete('/{id}', [PenjualanController::class, 'destroy']);
});
