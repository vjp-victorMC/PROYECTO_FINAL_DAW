<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

//Retorna todos los usuarios de la base de dato
Route::get('/usuario', [UsuarioController::class, 'getAllUser']);

//Retorna el usuario pedido por el id
Route::get('/usuario/{id}', [UsuarioController::class, 'getUserByID']);

//TODO: Crea un usuario
Route::post('/usuario', [UsuarioController::class, 'setUser']);

Route::post('/usuario/login', [UsuarioController::class, 'login']);
Route::post('/usuario/register', [UsuarioController::class, 'register']);
