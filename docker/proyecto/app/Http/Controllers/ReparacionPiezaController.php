<?php

namespace App\Http\Controllers;

use App\Models\Reparacion;
use App\Models\Pieza;
use App\Models\ReparacionPieza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReparacionPiezaController extends Controller
{
    // Añadir piezas a una reparación y recalcular los costes
    public function addPiezaAReparacion(Request $request)
    {
        // 1. Validar datos de entrada
        $validator = Validator::make($request->all(), [
            'id_reparacion'  => 'required|exists:reparaciones,id_reparacion',
            'id_pieza'       => 'required|exists:piezas,id_pieza', // Cambiar a 'id' si tu tabla piezas usa 'id'
            'cantidad_usada' => 'required|integer|min:1',
            'id_usuario'     => 'required|exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            // 2. Buscar la reparación y la pieza
            $reparacion = Reparacion::find($request->id_reparacion);
            $pieza = Pieza::find($request->id_pieza);

            // Control de estado: Evitar modificar reparaciones finalizadas
            if ($reparacion->estado === 'finalizado') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No se pueden añadir piezas a una reparación ya finalizada.'
                ], 400);
            }

            // Control de Stock (Asumiendo que tu tabla piezas tiene la columna 'stock')
            if ($pieza->stock < $request->cantidad_usada) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Stock insuficiente. Unidades disponibles: {$pieza->stock}."
                ], 400);
            }

            // 3. Ejecutar operaciones encadenadas en una transacción
            $resultado = DB::transaction(function () use ($request, $reparacion, $pieza) {
                // A. Registrar la pieza usada en la tabla intermedia
                $nuevaRelacion = ReparacionPieza::create([
                    'id_reparacion'  => $request->id_reparacion,
                    'id_pieza'       => $request->id_pieza,
                    'cantidad_usada' => $request->cantidad_usada,
                    'id_usuario'     => $request->id_usuario,
                ]);

                // B. Descontar las unidades del stock de la pieza
                $pieza->decrement('stock', $request->cantidad_usada);

                // C. Calcular coste de las nuevas piezas (cantidad * precio de la pieza)
                // Nota: Asegúrate de que el modelo Pieza tenga la columna 'precio' o 'coste'
                $costeNuevasPiezas = $request->get('cantidad_usada') * $pieza->precio;

                // D. Actualizar totales de la reparación
                $nuevoCosteTotalPiezas = $reparacion->coste_total_piezas + $costeNuevasPiezas;
                $nuevoCosteTotalReparacion = $reparacion->coste_mano_obra + $nuevoCosteTotalPiezas;

                $reparacion->update([
                    'coste_total_piezas'     => $nuevoCosteTotalPiezas,
                    'coste_total_reparacion' => $nuevoCosteTotalReparacion,
                    'estado'                 => $reparacion->estado === 'pendiente' ? 'en proceso' : $reparacion->estado
                ]);

                return [
                    'relacion'   => $nuevaRelacion,
                    'reparacion' => $reparacion
                ];
            });

            // 4. Respuesta de éxito
            return response()->json([
                'status'  => 'success',
                'message' => 'Pieza añadida correctamente y costes actualizados.',
                'data'    => [
                    'id_registro'            => $resultado['relacion']->id,
                    'id_reparacion'          => $resultado['reparacion']->id_reparacion,
                    'pieza_añadida'          => $pieza->nombre, // Asumiendo columna 'nombre'
                    'cantidad_usada'         => $request->cantidad_usada,
                    'coste_total_piezas'     => $resultado['reparacion']->coste_total_piezas,
                    'coste_total_reparacion' => $resultado['reparacion']->coste_total_reparacion,
                    'estado_reparacion'      => $resultado['reparacion']->estado
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al añadir la pieza a la reparación.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
