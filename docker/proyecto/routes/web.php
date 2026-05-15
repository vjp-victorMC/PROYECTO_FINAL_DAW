<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('usuario.welcome');
})-> name ('welcome');

Route::get('/servicios', function () {
    return view('usuario.servicios');
})-> name ('servicios');

Route::get('/segunda-mano', function () {
    return view('usuario.segunda-mano');
})->name ('segunda_mano');

Route::get('/nosotros', function () {
    return view('usuario.nosotros');
})-> name ('nosotros');

Route::get('/login', function () {
    return view('login');
})-> name ('login');

Route::get('/contacto', function () {
    return view('usuario.contacto');
})-> name ('login');

Route::get('/financiacion', function () {
    return view('usuario.fiananciacion');
})-> name ('financiacion');
