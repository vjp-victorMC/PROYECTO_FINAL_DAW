<?php

use App\Http\Controllers\CocheController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Coche2manoController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\ReparacionController;

//------ RUTAS PUBLICAS ------
//Retorna todos los coches de 2 mano de la base de datos
Route::get('/coche2mano', [Coche2manoController::class, 'getAll2HandCar']);

//Retorna todos los usuarios de la base de dato
Route::get('/usuario', [UsuarioController::class, 'getAllUser']);

//Metodo para logearse en la aplicacion
Route::post('/usuario/login', [UsuarioController::class, 'login']);

//Metodo para hacer logout
Route::post('/usuario/logout', [UsuarioController::class, 'logout']);

//Metodo para crear un nuevo usuario
Route::post('/usuario/newUser', [UsuarioController::class, 'setNewUser']);

//Crear un nuevo coche para un usuario
Route::post('/usuario/newCar', [CocheController::class, 'setNewCar']);

//Metodo para enviar un mensaje de reparaicon al admin
Route::post('/usuario/mensaje', [MensajeController::class, 'mensajesCliente']);

//Retorna el id del usuario por su dni
Route::get('/usuario/getId/{dni}', [UsuarioController::class, 'getIdByDni']);

//Obtiene los coches de un usuario
Route::get('/usuario/cars/{id}', [CocheController::class, 'getUsuarioCars']);

//Retorna el usuario pedido por el id
Route::get('/usuario/{id}', [UsuarioController::class, 'getUserByID']);


//------ RUTAS PRIVADAS ------
Route::middleware('auth:sanctum')->group(function () {

    // Solo mecánicos
    Route::middleware('role:mecanico')->group(function () {
    });

    // Solo administradores
    Route::middleware('role:admin')->group(function () {

        //Retorna el numero de coches que faltan por pagar
        Route::get('/admin/coches/para-pagar', [CocheController::class, 'getCochesParaPagar']);

        //Retorna el numero de coches que estan reparandose
        Route::get('/admin/reparaciones/en-proceso/count', [ReparacionController::class, 'getReparacionesEnProcesoCount']);

        //Retorna los coches que estan en el garaje
        Route::get('/admin/coches/garaje', [CocheController::class, 'getCochesEnGaraje']);

        //Crea una reparacion
        Route::post('/admin/reparaciones', [ReparacionController::class, 'setNewReparacion']);

        //Retorna los mensajes recibidos de un id de usuario
        Route::get('/admin/mensajes/recibidos/{id_recibo}', [MensajeController::class, 'obtenerMensajesRecibidos']);

        //Elimina un mensaje por su id
        Route::delete('/admin/mensaje/{id_mensaje}', [MensajeController::class, 'eliminarMensaje']);

    });
});
