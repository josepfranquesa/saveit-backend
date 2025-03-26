<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::apiResource('users', UserController::class);
Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware(['auth:api'])->post('/logout', [UserController::class, 'logout']);


Route::apiResource('accounts', AccountController::class);
Route::get('/accounts/user/{id}', [AccountController::class, 'getAccountsForUser']);

Route::apiResource('register', RegisterController::class);
