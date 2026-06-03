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
    public function addPiezaAReparacion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_reparacion'  => 'required|exists:reparaciones,id_reparacion',
            'id_pieza'       => 'required|exists:piezas,id_pieza',
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
            $reparacion = Reparacion::find($request->id_reparacion);
            $pieza      = Pieza::find($request->id_pieza);

            if ($reparacion->estado === 'finalizada') {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'No se pueden añadir piezas a una reparación ya finalizada.'
                ], 400);
            }

            // ✅ Columna correcta: cantidad_disponible
            if ($pieza->cantidad_disponible < (int) $request->cantidad_usada) {
                return response()->json([
                    'status'  => 'error',
                    'message' => "Stock insuficiente. Unidades disponibles: {$pieza->cantidad_disponible}."
                ], 400);
            }

            $resultado = DB::transaction(function () use ($request, $reparacion, $pieza) {
                $nuevaRelacion = ReparacionPieza::create([
                    'id_reparacion'  => $request->id_reparacion,
                    'id_pieza'       => $request->id_pieza,
                    'cantidad_usada' => $request->cantidad_usada,
                    'id_usuario'     => $request->id_usuario,
                ]);

                // ✅ Descontar de cantidad_disponible
                $pieza->decrement('cantidad_disponible', $request->cantidad_usada);

                // ✅ Precio correcto: precio_venta
                $costeNuevasPiezas       = (int) $request->cantidad_usada * $pieza->precio_venta;
                $nuevoCosteTotalPiezas   = $reparacion->coste_total_piezas + $costeNuevasPiezas;
                $nuevoCosteTotalReparacion = $reparacion->coste_mano_obra + $nuevoCosteTotalPiezas;

                $reparacion->update([
                    'coste_total_piezas'     => $nuevoCosteTotalPiezas,
                    'coste_total_reparacion' => $nuevoCosteTotalReparacion,
                    'estado'                 => $reparacion->estado === 'pendiente' ? 'en proceso' : $reparacion->estado,
                ]);

                return [
                    'relacion'   => $nuevaRelacion,
                    'reparacion' => $reparacion,
                ];
            });

            return response()->json([
                'status'  => 'success',
                'message' => 'Pieza añadida correctamente y costes actualizados.',
                'data'    => [
                    'id_registro'            => $resultado['relacion']->id,
                    'id_reparacion'          => $resultado['reparacion']->id_reparacion,
                    'pieza_añadida'          => $pieza->nombre_pieza,         // ✅
                    'cantidad_usada'         => $request->cantidad_usada,
                    'stock_restante'         => $pieza->cantidad_disponible,   // ✅ útil para el frontend
                    'coste_total_piezas'     => $resultado['reparacion']->coste_total_piezas,
                    'coste_total_reparacion' => $resultado['reparacion']->coste_total_reparacion,
                    'estado_reparacion'      => $resultado['reparacion']->estado,
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
