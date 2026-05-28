<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MensajeController extends Controller
{
    public function mensajesCliente(Request $request)
    {
        // 1. Validar los datos de entrada incluyendo la matrícula
        $validator = Validator::make($request->all(), [
            'usuario_envio' => 'required|exists:usuarios,id_usuario',
            'matricula'     => 'required|string|max:15',
            'asunto'        => 'required|string|max:150',
            'mensaje'       => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        // 2. Buscar al administrador del sistema dinámicamente
        $admin = Usuario::where('rol', 'admin')->first();
        $idAdmin = $admin ? $admin->id_usuario : 6;

        // 3. Crear el mensaje con el campo matrícula
        $nuevoMensaje = Mensaje::create([
            'usuario_envio'  => $request->usuario_envio,
            'usuario_recibo' => $idAdmin,
            'matricula'      => $request->matricula,
            'asunto'         => $request->asunto,
            'mensaje'        => $request->mensaje,
        ]);

        // 4. Respuesta
        return response()->json([
            'status'  => 'success',
            'message' => 'Mensaje enviado al administrador correctamente.',
            'data'    => $nuevoMensaje
        ], 201);
    }

    public function obtenerMensajesRecibidos($id_recibo)
    {
        // 1. Verificar si el usuario receptor existe
        $usuarioExiste = Usuario::where('id_usuario', $id_recibo)->exists();

        if (!$usuarioExiste) {
            return response()->json([
                'status' => 'error',
                'message' => 'El usuario receptor especificado no existe.'
            ], 404);
        }

        // 2. Buscar solo los mensajes donde el usuario es el receptor
        // Ordenados del más reciente al más antiguo
        $mensajes = Mensaje::where('usuario_recibo', $id_recibo)
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. Devolver la colección de mensajes
        return response()->json([
            'status'  => 'success',
            'count'   => $mensajes->count(),
            'data'    => $mensajes
        ], 200);
    }

    // Eliminar un mensaje por su ID
    public function eliminarMensaje($id_mensaje)
    {
        // 1. Buscar el mensaje por su clave primaria
        // Nota: Asegúrate de que el nombre del campo en tu modelo coincida (id o id_mensaje)
        $mensaje = Mensaje::find($id_mensaje);

        // 2. Si no existe, devolver error 404
        if (!$mensaje) {
            return response()->json([
                'status'  => 'error',
                'message' => 'El mensaje especificado no existe.'
            ], 404);
        }

        // 3. Eliminar el registro de la base de datos
        $mensaje->delete();

        // 4. Respuesta de éxito
        return response()->json([
            'status'  => 'success',
            'message' => 'Mensaje eliminado correctamente.'
        ], 200);
    }

}
