<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/','UserController@navbar')->name('navbar');
Route::get('/homeuser', [UserController::class, 'homeuser'])
    ->name('homeuser');