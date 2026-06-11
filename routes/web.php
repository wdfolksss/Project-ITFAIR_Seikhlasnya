<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', [UserController::class, 'homeuser'])->name('home');
Route::get('/homeuser', [UserController::class, 'homeuser'])->name('homeuser');
Route::post('/laporan', [ReportController::class, 'store'])->name('reports.store');
