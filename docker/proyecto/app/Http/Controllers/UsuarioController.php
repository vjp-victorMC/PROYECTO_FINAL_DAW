<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Obtener todos los usuarios
    public function getAllUser() {
        // Recupera solo los campos necesarios por seguridad
        $usuarios = Usuario::select('id', 'nombre', 'email', 'dni', 'rol')->get();

        return response()->json([
            'success' => true,
            'data' => $usuarios
        ], 200);
    }

    // Obtener un usuario por su ID
    public function getUserByID($id) {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'success' => false,
                'msg' => 'Usuario no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $usuario->id,
                'nombre' => $usuario->nombre,
                'email' => $usuario->email,
                'dni' => $usuario->dni,
                'rol' => $usuario->rol
            ]
        ], 200);
    }

    // LOGIN
    public function login(Request $request) {
        $request->validate([
            'identificador' => 'required',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('email', $request->identificador)
                        ->orWhere('dni', $request->identificador)
                        ->first();

        // Si no existe o la contraseña es incorrecta
        if (!$usuario || !Hash::check($request->password, $usuario->contraseña)) {
            return response()->json([
                'success' => false,
                'msg' => 'Credenciales incorrectas'
            ], 401);
        }

        // Auth::login() es quien crea la cookie de sesión
        Auth::login($usuario);

        return response()->json([
            'success' => true,
            'nombre' => $usuario->nombre,
            'rol' => $usuario->rol
        ]);
    }
    // REGISTRO: nombre, email, dni, password (confirm), rol=cliente
    public function setNewUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'dni' => 'required|unique:usuarios,dni',
            'password' => 'required|min:4|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'dni' => $request->dni,
            'contraseña' => Hash::make($request->password),
            'rol' => 'cliente'
        ]);

        // Opcional: iniciar sesión automáticamente
        Auth::login($usuario);

        return response()->json([
            'success' => true,
            'rol' => 'cliente',
            'nombre' => $usuario->nombre,
            'id_usuario' => $usuario->id_usuario,
        ], 201);
    }

    // LOGOUT
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate(); // destruye la sesión del servidor
        $request->session()->regenerateToken(); // regenera token CSRF por seguridad

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('welcome');
    }
}
