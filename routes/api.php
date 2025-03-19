<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware(['auth:api'])->post('/logout', [UserController::class, 'logout']);

// Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::apiResource('users', UserController::class);
