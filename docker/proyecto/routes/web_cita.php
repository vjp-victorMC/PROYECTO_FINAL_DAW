<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;

Route::middleware(['auth'])->group(function () {
    Route::get('/cita', [CitaController::class, 'showForm'])->name('cita');
});
