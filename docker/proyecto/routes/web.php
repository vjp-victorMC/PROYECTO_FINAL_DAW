<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('usuario.welcome');
});

Route::get('/servicios', function () {
    return view('usuario.servicios');
});

Route::get('/segunda-mano', function () {
    return view('usuario.segunda-mano');
});

Route::get('/nosotros', function () {
    return view('usuario.nosotros');
});

Route::get('/login', function () {
    return view('login');
});

