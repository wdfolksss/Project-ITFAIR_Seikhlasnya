<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'homeUser'])->name('home');
Route::get('/homeUser', [UserController::class, 'homeUser'])->name('homeUser');
Route::get('/formLaporan', [UserController::class, 'formLaporan'])->name('formLaporan');
Route::get('/laporanPublik', [UserController::class, 'laporanPublik'])->name('laporanPublik');
Route::get('/detailLaporan', [UserController::class, 'detailLaporan'])->name('detailLaporan');
