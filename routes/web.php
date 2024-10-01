<?php

use AndriesReitsma\Visa\Http\Controllers\AuthenticationController;
use AndriesReitsma\Visa\Http\Controllers\CookieController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthenticationController::class, 'store'])
    ->middleware('web')
    ->name('login');

Route::post('logout', [AuthenticationController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('cookie', CookieController::class)
    ->name('cookie');
