<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Storage;

Route::get('/', [UserController::class, 'homeUser'])->name('home');
Route::get('/homeUser', [UserController::class, 'homeUser'])->name('homeUser');
Route::get('/formLaporan', [UserController::class, 'formLaporan'])->name('formLaporan');
Route::get('/laporanPublik', [UserController::class, 'laporanPublik'])->name('laporanPublik');
Route::get('/detailLaporan', [UserController::class, 'detailLaporan'])->name('detailLaporan');
Route::post('/formLaporan', [LaporanController::class, 'store'])->name('reports.store');
Route::get('/foto-laporan/{path}', function ($path) {
    return Storage::disk('public')->response($path);
})->where('path', '.*')->name('foto.laporan');

Route::get('/adminLogin', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
