<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function login(Request $request) {
        // Buscamos si el identificador coincide con el email O con el dni
        $usuario = Usuario::where(function($query) use ($request) {
                $query->where('email', $request->identificador)
                      ->orWhere('dni', $request->identificador); // Busca en ambos
            })
            ->where('contraseña', $request->password)
            ->first();

        if ($usuario) {
            return response()->json([
                'success' => true,
                'rol' => $usuario->rol
            ]);
        }

        return response()->json(['success' => false, 'msg' => 'Credenciales incorrectas'], 401);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'dni' => 'required|unique:usuarios,dni', // El DNI debe ser único también
            'password' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Siempre se registra como 'cliente'
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'dni' => $request->dni,
            'contraseña' => $request->password,
            'rol' => 'cliente'
        ]);

        return response()->json(['success' => true, 'rol' => 'cliente'], 201);
    }
}
