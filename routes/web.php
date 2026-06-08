<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'homeuser'])->name('home');
Route::get('/homeuser', [UserController::class, 'homeuser'])->name('homeuser');
Route::get('/formlaporan', [UserController::class, 'formlaporan'])->name('formlaporan');