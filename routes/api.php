<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\GraphController;
use App\Repositories\UserAccountRepository;

// Rutas públicas (sin autenticación)
Route::post('/login', [UserController::class, 'login']);
Route::post('/users', [UserController::class, 'store']);


// Rutas protegidas con Sanctum
Route::middleware(['auth:sanctum'])->group(function () {

    // Autenticación
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/checkToken', [UserController::class, 'checkToken']);

    // Usuarios
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/users/account/{id}', [UserController::class, 'getUsersForAccount']);

    // Cuentas
    Route::get('/accounts/user/{id}', [AccountController::class, 'getAccountsForUser']);
    Route::post('/accounts', [AccountController::class, 'store']);
    Route::post('/accounts/join', [AccountController::class, 'joinAccount']);
    Route::delete('/account/user/{account_id}/{user_id}', [UserAccountRepository::class, 'delete']);

    // Registros
    Route::post('/register/account', [RegisterController::class, 'store']);
    Route::put('/register/account/{id}', [RegisterController::class, 'update']);
    Route::delete('/register/account/{id}', [RegisterController::class, 'destroy']);
    Route::get('/register/account/{id}', [RegisterController::class, 'getRegistersForAccount']);
    Route::put('/register/account/{id}/update_category/{id_category}', [RegisterController::class, 'updateCategory']);
    Route::get('/register/total/no_category/{accountId}', [RegisterController::class, 'getTotalsNoCategory']);

    // Categorías
    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category/account/{account_id}', [CategoryController::class, 'getCategoryForAccount']);
    Route::delete('/category/account/{id}/{accountId}', [CategoryController::class, 'destroyCategoryAccount']);

    // Subcategorías
    Route::post('/subcategory', [SubCategoryController::class, 'store']);
    Route::get('/subcategory/account/{account_id}', [SubCategoryController::class, 'getSubcategoryForAccount']);
    Route::get('/subcategory/category/{category_id}/{account_id}', [SubCategoryController::class, 'getSubcategoryForCategoryAccount']);
    Route::delete('/subcategory/account/{id}/{accountId}', [SubCategoryController::class, 'destroySubcategoryAccount']);

    // Objetivos y límites
    Route::post('/objective', [ObjectiveController::class, 'storeObjective']);
    Route::post('/limit', [ObjectiveController::class, 'storeLimit']);
    Route::get('/objective/{acount_id}', [ObjectiveController::class, 'getGoalAccount']);
    Route::get('/limit/{acount_id}', [ObjectiveController::class, 'getLimitAccount']);
    Route::delete('/objective/{id}', [ObjectiveController::class, 'destroyObjectiveAccount']);
    Route::delete('/limit/{id}', [ObjectiveController::class, 'destroyLimitAccount']);

    // Gráficos
    Route::post('/graph', [GraphController::class, 'getInfoForGraph']);
    Route::get('/graph/{acount_id}', [GraphController::class, 'getGraphs']);
    Route::delete('/graph/{id}', [GraphController::class, 'destroyGraph']);
});
