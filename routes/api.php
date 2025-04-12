<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Repositories\UserAccountRepository;

    Route::middleware(['auth:api'])->post('/logout', [UserController::class, 'logout']);
    //Route::apiResource('users', UserController::class);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/checkToken', [UserController::class, 'checkToken']);



    //Route::apiResource('accounts', AccountController::class);
    Route::get('/accounts/user/{id}', [AccountController::class, 'getAccountsForUser']);
    Route::post('/accounts', [AccountController::class, 'store']);
    Route::post('/accounts/join', [AccountController::class, 'joinAccount']);


    Route::get('/register/account/{id}', [RegisterController::class, 'getRegistersForAccount']);


    Route::delete('/account/user/{account_id}/{user_id}', [UserAccountRepository::class, 'delete']);


    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category/account/{account_id}', [CategoryController::class, 'getCategoryForAccount']);


    Route::post('/subcategory', [SubCategoryController::class, 'store']);
    Route::get('/subcategory/category/{category_id}/{account_id}', [SubCategoryController::class, 'getSubcategoryForCategoryAccount']);
