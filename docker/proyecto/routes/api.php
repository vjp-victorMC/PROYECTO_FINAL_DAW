<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

//------ RUTAS PUBLICAS ------
//Retorna todos los usuarios de la base de dato
Route::get('/usuario', [UsuarioController::class, 'getAllUser']);

//Metodo para logearse en la aplicacion
Route::post('/usuario/login', [UsuarioController::class, 'login']);

//Metodo para hacer logout
Route::post('/usuario/logout', [UsuarioController::class, 'logout']);

//Metodo para crear un nuevo usuario
Route::post('/usuario/newUser', [UsuarioController::class, 'setNewUser']);

//Retorna el usuario pedido por el id
Route::get('/usuario/{id}', [UsuarioController::class, 'getUserByID']);

//------ RUTAS PRIVADAS ------
Route::middleware('auth:sanctum')->group(function () {

    // Solo mecánicos
    Route::middleware('role:mecanico')->group(function () {
    });

    // Solo administradores
    Route::middleware('role:administrador')->group(function () {
    });
});
