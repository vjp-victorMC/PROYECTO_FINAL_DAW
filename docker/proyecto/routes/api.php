<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

//Retorna todos los usuarios de la base de dato
Route::get('/usuarios', [UsuarioController::class, 'getAllUser']);

//Retorna el usuario pedido por el id
Route::get('/usuarios/{id}', [UsuarioController::class, 'getUserByID']);

//TODO: Crea un usuario
Route::post('/usuarios', [UsuarioController::class, 'setUser']);
