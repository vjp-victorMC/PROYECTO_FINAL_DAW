<?php

namespace App\Http\Controllers;

use App\Models\Reparacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReparacionController extends Controller
{
    // Registrar una nueva reparación con valores iniciales por defecto
    public function setNewReparacion(Request $request)
    {
        // 1. Validar los datos obligatorios recibidos por Request
        $validator = Validator::make($request->all(), [
            'id_coche' => 'required|exists:coches,id_coche',
            'motivo'   => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        // 2. Crear la reparación con los valores por defecto solicitados
        $nuevaReparacion = Reparacion::create([
            'id_coche'               => $request->id_coche,
            'motivo'                 => $request->motivo,
            'id_mecanico'            => null, // Sin asignar
            'horas_trabajo'          => 0.00,
            'coste_mano_obra'        => 0.00,
            'coste_total_piezas'     => 0.00,
            'coste_total_reparacion' => 0.00,
            // fecha_entrada se establece automáticamente con useCurrent()
            'fecha_salida'           => null,
            'estado'                 => 'pendiente',
        ]);

        // 3. Respuesta de éxito
        return response()->json([
            'status'  => 'success',
            'message' => 'Reparación registrada correctamente en estado pendiente.',
            'data'    => $nuevaReparacion
        ], 201);
    }

    // Obtener la cantidad de reparaciones que están "en proceso"
    public function getReparacionesEnProcesoCount()
    {
        // 1. Contar directamente los registros cuyo estado sea 'en proceso'
        $conteo = Reparacion::where('estado', 'en proceso')->count();

        // 2. Retornar la respuesta en formato JSON
        return response()->json([
            'status' => 'success',
            'count'  => $conteo
        ], 200);
    }

}
