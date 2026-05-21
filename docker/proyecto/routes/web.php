<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;


//------ RUTAS PUBLICAS ------

//USUARIO
Route::get('/', function () {
    return view('usuario.welcome');
})->name('welcome');

Route::get('/servicios', function () {
    return view('usuario.servicios');
})->name('servicios');

Route::get('/ocasion', function () {
    return view('usuario.ocasion');
})->name('ocasion');

Route::get('/nosotros', function () {
    return view('usuario.nosotros');
})->name('nosotros');

Route::get('/compra', function () {
    return view('usuario.compra');
})->name('compra');

Route::get('/contacto', function () {
    return view('usuario.contacto');
})->name('contacto');

Route::get('login', function () {
    return view('login');
})->name("login");

Route::get('/vehiculo', function () {
    return view('usuario.vehiculo');
})->name('vehiculo');

Route::post('logout', [UsuarioController::class, 'logout'])->name('logout');

// Route::get('/admin', function () {
//     return view('administrativo.admin');
// });

        Route::get('/mecanico', function () {
            return view('mecanico.mecanico');
        })->name("mecanico");


//------ RUTAS PRIVADAS ------
Route::middleware('auth:sanctum')->group(function () {

    //MECANICO
    // Route::middleware('role:mecanico')->group(function () {

    //     Route::get('/mecanico', function () {
    //         return view('login');
    //     })->name("login");

    // });


    //ADMINISTRADOR
    Route::middleware('role:admin')->group(function () {

        Route::get('/admin', function () {
            return view('administrativo.admin');
        });
    });
});
