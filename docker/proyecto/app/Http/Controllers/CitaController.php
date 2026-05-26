<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function showForm()
    {
        $user = Auth::user();
        return view('usuario.cita', compact('user'));
    }
}
