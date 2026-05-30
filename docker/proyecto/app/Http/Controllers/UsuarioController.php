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
        $usuarios = Usuario::select('id_usuario', 'nombre', 'email', 'dni', 'telefono', 'rol')->get();

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
                'id_usuario' => $usuario->id,
                'nombre' => $usuario->nombre,
                'email' => $usuario->email,
                'dni' => $usuario->dni,
                'telefono' => $usuario->telefono,
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

    // Obtener ID de usuario mediante DNI
    public function getIdByDni($dni) {
        $usuario = Usuario::where('dni', $dni)->first();

        if (!$usuario) {
            return response()->json([
                'success' => false,
                'msg' => 'No se encontró ningún usuario con ese DNI'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'id_usuario' => $usuario->id_usuario
        ], 200);
    }

    // REGISTRO: nombre, email, dni, password (confirm), rol=cliente
    public function setNewUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'dni' => 'required|unique:usuarios,dni',
            'telefono' => 'required|string|max:20',
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
            'telefono' => $request->telefono,
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

    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:255',
            'email'      => 'required|email|max:100|unique:usuarios,email',
            'dni'        => 'required|string|max:20|unique:usuarios,dni',
            'telefono'   => 'nullable|string|max:15',
            'contraseña' => 'required|string|min:6',
            'rol'        => 'required|string|in:mecanico,cliente,admin,administrador',
        ]);

        $rol = $request->rol === 'administrador' ? 'admin' : $request->rol;

        $usuario = Usuario::create([
            'nombre'     => $request->nombre,
            'email'      => $request->email,
            'dni'        => $request->dni,
            'telefono'   => $request->telefono,
            'contraseña' => Hash::make($request->contraseña), // Encriptación segura para Auth
            'rol'        => $rol,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Usuario creado con éxito.',
            'data'    => $usuario
        ], 201);
    }

    // 2. Editar un usuario por su ID
    public function update(Request $request, $id_usuario)
    {
        $usuario = Usuario::find($id_usuario);

        if (!$usuario) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Usuario no encontrado.'
            ], 404);
        }

        $request->validate([
            'nombre'     => 'sometimes|required|string|max:255',
            'email'      => 'sometimes|required|email|max:100|unique:usuarios,email,' . $id_usuario . ',id_usuario',
            'dni'        => 'sometimes|required|string|max:20|unique:usuarios,dni,' . $id_usuario . ',id_usuario',
            'telefono'   => 'nullable|string|max:15',
            'contraseña' => 'sometimes|required|string|min:6',
            'rol'        => 'sometimes|required|string|in:mecanico,cliente,admin,administrador',
        ]);

        // Recogemos todos los datos excepto la contraseña inicialmente
        $data = $request->except(['contraseña']);

        // Normalizar rol admin/administrador a la columna actual
        if ($request->filled('rol')) {
            $data['rol'] = $request->rol === 'administrador' ? 'admin' : $request->rol;
        }

        // Si se envía una nueva contraseña, la encriptamos antes de guardar
        if ($request->filled('contraseña')) {
            $data['contraseña'] = Hash::make($request->contraseña);
        }

        $usuario->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Usuario actualizado con éxito.',
            'data'    => $usuario
        ], 200);
    }

    // 3. Eliminar un usuario por su ID
    public function destroy($id_usuario)
    {
        $usuario = Usuario::find($id_usuario);

        if (!$usuario) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Usuario no encontrado.'
            ], 404);
        }

        $usuario->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Usuario eliminado correctamente.'
        ], 200);
    }

    // 4. Obtener las métricas totales agrupadas por cada tipo de rol
    public function getMetricasRoles()
    {
        // Contamos cada rol de forma independiente en la base de datos
        $mecanicos       = Usuario::where('rol', 'mecanico')->count();
        $clientes        = Usuario::where('rol', 'cliente')->count();
        $administradores = Usuario::whereIn('rol', ['admin', 'administrador'])->count();

        return response()->json([
            'status' => 'success',
            'data'   => [
                'total_mecanicos'       => $mecanicos,
                'total_clientes'        => $clientes,
                'total_administradores' => $administradores,
                'total_usuarios'        => $mecanicos + $clientes + $administradores
            ]
        ], 200);
    }
}
