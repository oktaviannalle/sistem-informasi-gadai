<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\BarangGadaiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiGadaiController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('nasabah', NasabahController::class);
    Route::resource('barang-gadai', BarangGadaiController::class);
    Route::resource('transaksi', TransaksiGadaiController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::patch('transaksi/{transaksi}/status', [TransaksiGadaiController::class, 'updateStatus'])->name('transaksi.updateStatus');
    Route::get('transaksi/{transaksi}/cetak', [TransaksiGadaiController::class, 'cetak'])->name('transaksi.cetak');
    Route::post('transaksi/{transaksi}/kirim-pengingat', [TransaksiGadaiController::class, 'kirimPengingat'])->name('transaksi.kirimPengingat');
});

require __DIR__.'/auth.php';
