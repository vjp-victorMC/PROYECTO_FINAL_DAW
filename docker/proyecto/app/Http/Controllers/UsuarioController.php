<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function getAllUser() {
        return response()->json(Usuario::all(), 200);
    }

    public function getUserByID($id) {
        $usuario = Usuario::find($id);
        if (!$usuario) return response()->json(['msg' => 'No encontrado'], 404);
        return response()->json($usuario, 200);
    }

    public function setUser(Request $request) {
        $usuario = Usuario::create($request->all());
        return response()->json($usuario, 201);
    }
}
