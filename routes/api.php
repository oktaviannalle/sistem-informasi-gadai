<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BarangGadaiApiController;
use App\Http\Controllers\Api\NasabahApiController;
use App\Http\Controllers\Api\TransaksiGadaiApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);

    Route::get('/nasabah', [NasabahApiController::class, 'index']);
    Route::get('/nasabah/{nasabah}', [NasabahApiController::class, 'show']);

    Route::get('/barang-gadai', [BarangGadaiApiController::class, 'index']);
    Route::get('/barang-gadai/{barangGadai}', [BarangGadaiApiController::class, 'show']);

    Route::get('/transaksi', [TransaksiGadaiApiController::class, 'index']);
    Route::get('/transaksi/{transaksi}', [TransaksiGadaiApiController::class, 'show']);
    Route::post('/transaksi', [TransaksiGadaiApiController::class, 'store']);
});
