<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Services\AIClusteringService;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'homeuser'])->name('home');
Route::get('/homeuser', [UserController::class, 'homeuser'])->name('homeuser');
Route::get('/formLaporan', [UserController::class, 'formLaporan'])->name('formLaporan');
Route::get('/laporanPublik', [UserController::class, 'laporanPublik'])->name('laporanPublik');
Route::get('/detailLaporan/{id}', [UserController::class, 'detailLaporan'])
    ->name('detailLaporan');

Route::get('/adminLogin', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/laporan/store', [LaporanController::class, 'store'])->name('laporan.store');
Route::get('/laporanPublik', [LaporanController::class, 'index'])->name('laporanPublik');

Route::get('/test-ai', function () {
    return dd(app(AIClusteringService::class)->getPriorityResult());
});

Route::get('/verify', function () {

    return app(\App\Services\BlockchainService::class)
            ->verifyBlockchain();

});