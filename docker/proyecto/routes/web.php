<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/servicios', function () {
    return view('servicios');
});

Route::get('/segunda-mano', function () {
    return view('segunda-mano');
});

Route::get('/nosotros', function () {
    return view('nosotros');
});

Route::get('/login', function () {
    return view('login');
});

