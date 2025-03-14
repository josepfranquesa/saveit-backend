<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/register', [UserController::class, 'store'])->name('users.store');

Route::apiResource('users', UserController::class);
