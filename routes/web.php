<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', 'UserController@store')->name('users.store');   // Crear usuario
Route::get('/users', 'UserController@index')->name('users.index');    // Obtener todos los usuarios
Route::get('/users/{id}', 'UserController@show')->name('users.show'); // Obtener un usuario por ID
Route::put('/users/{id}', 'UserController@update')->name('users.update'); // Actualizar un usuario
Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy'); // Eliminar un usuario
