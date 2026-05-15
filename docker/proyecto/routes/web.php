<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('usuario.welcome');
})-> name ('welcome');

Route::get('/servicios', function () {
    return view('usuario.servicios');
})-> name ('servicios');

Route::get('/ocasion', function () {
    return view('usuario.ocasion');
})->name('ocasion');

Route::get('/nosotros', function () {
    return view('usuario.nosotros');
})-> name ('nosotros');

Route::get('/login', function () {
    return view('login');
})-> name ('login');

Route::get('/contacto', function () {
    return view('usuario.contacto');
})-> name ('contacto');

Route::get('/financiacion', function () {
    return view('usuario.financiacion');
})->name('financiacion');
