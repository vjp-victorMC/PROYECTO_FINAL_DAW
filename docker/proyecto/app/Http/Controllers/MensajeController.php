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
}
