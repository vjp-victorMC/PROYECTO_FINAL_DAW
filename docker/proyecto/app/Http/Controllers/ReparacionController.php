<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use App\Models\Reparacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        //3. Metemos el coche en el taller
        $coche = Coche::find($request->id_coche);
        $coche->update(['en_garaje' => 1]);

        // 4. Respuesta de éxito
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

    public function getEstadoReparacion(Request $request)
    {
        // 1. Validar que se envíe al menos un parámetro de búsqueda
        $validator = Validator::make($request->all(), [
            'buscar' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        $termino = $request->input('buscar');

        // 2. Buscar el coche por ID o por Matrícula
        $coche = Coche::where('id_coche', $termino)
                    ->orWhere('matricula', $termino)
                    ->first();

        if (!$coche) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vehículo no encontrado en el sistema.'
            ], 404);
        }

        // 3. Obtener la última reparación registrada para ese coche
        $ultimaReparacion = Reparacion::where('id_coche', $coche->id_coche)
                                    ->latest('id_reparacion') // Ordena por la más reciente
                                    ->first();

        if (!$ultimaReparacion) {
            return response()->json([
                'status' => 'success',
                'message' => 'El vehículo no tiene ningún historial de reparaciones.',
                'en_garaje' => $coche->en_garaje,
                'estado_reparacion' => 'sin reparaciones'
            ], 200);
        }

        // 4. Retornar el estado actual
        return response()->json([
            'status' => 'success',
            'coche' => [
                'id_coche' => $coche->id_coche,
                'matricula' => $coche->matricula,
                'marca' => $coche->marca,
                'modelo' => $coche->modelo,
                'en_garaje' => $coche->en_garaje
            ],
            'reparacion' => [
                'id_reparacion' => $ultimaReparacion->id_reparacion,
                'motivo' => $ultimaReparacion->motivo,
                'estado' => $ultimaReparacion->estado,
                'fecha_entrada' => $ultimaReparacion->fecha_entrada,
                'fecha_salida' => $ultimaReparacion->fecha_salida
            ]
        ], 200);
    }

    public function cobrarReparacion(Request $request)
    {
        // 1. Validar que se reciba el ID de la reparación obligatoriamente
        $validator = Validator::make($request->all(), [
            'id_reparacion' => 'required|exists:reparaciones,id_reparacion',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        // 2. Buscar la reparación
        $reparacion = Reparacion::find($request->id_reparacion);

        // 3. Control de errores: Evitar cobrar algo ya terminado o sin coste
        if ($reparacion->estado === 'finalizado') {
            return response()->json([
                'status' => 'error',
                'message' => 'Esta reparación ya ha sido cobrada y finalizada anteriormente.'
            ], 400);
        }

        if ($reparacion->coste_total_reparacion <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se puede cobrar una reparación con coste total de 0.00. Actualiza los costes primero.'
            ], 400);
        }

        // 4. Ejecutar operaciones encadenadas de forma segura
        try {
            $resultado = DB::transaction(function () use ($reparacion) {
                // A. Actualizar estado de la reparación y registrar fecha de salida
                $reparacion->update([
                    'estado'       => 'finalizado',
                    'fecha_salida' => now(),
                ]);

                // B. Sacar el coche del taller (en_garaje = 0)
                $coche = Coche::find($reparacion->id_coche);
                if ($coche) {
                    $coche->update(['en_garaje' => 0]);
                }

                // C. Registrar el ingreso en la tabla de contabilidad
                // Nota: Asegúrate de que el modelo Contabilidad esté importado o usa \App\Models\Contabilidad
                $ingreso = \App\Models\Contabilidad::create([
                    'tipo'       => 'ingreso',
                    'cantidad'   => $reparacion->coste_total_reparacion,
                    'concepto'   => "Cobro de reparación #" . $reparacion->id_reparacion . " - Matrícula: " . ($coche->matricula ?? 'N/A'),
                    'id_usuario' => $reparacion->id_mecanico, // Se asocia al mecánico que la realizó si existe
                    'fecha'      => now(),
                ]);

                return [
                    'reparacion' => $reparacion,
                    'coche'      => $coche,
                    'ingreso'    => $ingreso
                ];
        });

            // 5. Respuesta de éxito
            return response()->json([
                'status'  => 'success',
                'message' => 'Reparación cobrada con éxito. Vehículo retirado del taller e ingreso contabilizado.',
                'data'    => [
                    'id_reparacion'  => $resultado['reparacion']->id_reparacion,
                    'nuevo_estado'   => $resultado['reparacion']->estado,
                    'fecha_salida'   => $resultado['reparacion']->fecha_salida,
                    'total_cobrado'  => $resultado['reparacion']->coste_total_reparacion,
                    'coche_en_garaje'=> $resultado['coche']->en_garaje,
                    'id_contabilidad'=> $resultado['ingreso']->id
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Hubo un error al procesar el cobro: ' . $e->getMessage()
            ], 500);
        }
    }

    // Asignar un mecánico a una reparación y cambiar su estado a 'en proceso'
    public function asignarMecanico(Request $request)
    {
        // 1. Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'id_reparacion' => 'required|exists:reparaciones,id_reparacion',
            'id_mecanico'   => 'required|exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        // 2. Verificar que el usuario tenga el rol de mecánico
        $mecanico = \App\Models\Usuario::find($request->id_mecanico);
        if ($mecanico->rol !== 'mecanico') { // Ajusta a 'mecánico' si usas acento en tu BD
            return response()->json([
                'status' => 'error',
                'message' => 'El usuario seleccionado no tiene el rol de mecánico.'
            ], 400);
        }

        // 3. Buscar la reparación
        $reparacion = Reparacion::find($request->id_reparacion);

        // 4. Control de estado: Evitar modificar reparaciones ya finalizadas
        if ($reparacion->estado === 'finalizado') {
            return response()->json([
                'status' => 'error',
                'message' => 'No se puede asignar un mecánico a una reparación que ya está finalizada y cobrada.'
            ], 400);
        }

        // 5. Asignar el mecánico y pasar el estado a 'en proceso'
        $reparacion->update([
            'id_mecanico' => $mecanico->id_usuario,
            'estado'      => 'en proceso'
        ]);

        // 6. Respuesta de éxito
        return response()->json([
            'status'  => 'success',
            'message' => 'Mecánico asignado correctamente. La reparación ahora está en proceso.',
            'data'    => [
                'id_reparacion' => $reparacion->id_reparacion,
                'estado'        => $reparacion->estado,
                'mecanico' => [
                    'id_mecanico' => $mecanico->id_usuario,
                    'nombre'      => $mecanico->nombre
                ]
            ]
        ], 200);
    }

    public function getReparacionesCountPorEstado()
    {
        try {
            // 1. Contar y agrupar las reparaciones por su columna 'estado'
            $conteos = Reparacion::select('estado', DB::raw('count(*) as total'))
                ->groupBy('estado')
                ->pluck('total', 'estado')
                ->toArray();

            // 2. Retornar la respuesta con el formato de éxito del sistema
            return response()->json([
                'status' => 'success',
                'data'   => $conteos
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al obtener el conteo de reparaciones.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function getReparacionesPorMecanico(Request $request)
    {
        // 1. Validar que el id_mecanico exista en la tabla usuarios (clave primaria id_usuario)
        $validator = Validator::make($request->all(), [
            'id_mecanico' => 'required|exists:usuarios,id_usuario',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            // 2. Buscar las reparaciones asociadas al mecánico (ordenadas de la más reciente a la más antigua)
            $reparaciones = Reparacion::where('id_mecanico', $request->id_mecanico)
                ->with('coche') // Carga opcional de la relación si necesitas datos del vehículo
                ->latest('id_reparacion')
                ->get();

            // 3. Controlar si el mecánico aún no tiene reparaciones asignadas
            if ($reparaciones->isEmpty()) {
                return response()->json([
                    'status'  => 'success',
                    'message' => 'El mecánico no tiene reparaciones asignadas actualmente.',
                    'data'    => []
                ], 200);
            }

            // 4. Retornar el listado de reparaciones
            return response()->json([
                'status' => 'success',
                'count'  => $reparaciones->count(),
                'data'   => $reparaciones
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al obtener las reparaciones del mecánico.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // Añadir horas de trabajo y calcular el coste de mano de obra (12€/hora)
    public function addHorasTrabajo(Request $request)
    {
        // 1. Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'id_reparacion' => 'required|exists:reparaciones,id_reparacion',
            'horas'         => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            // 2. Buscar la reparación
            $reparacion = Reparacion::find($request->id_reparacion);

            // Control de errores: Evitar modificar una reparación ya finalizada
            if ($reparacion->estado === 'finalizado') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No se pueden añadir horas a una reparación ya finalizada y cobrada.'
                ], 400);
            }

            // 3. Calcular los nuevos valores
            $precioPorHora = 12.00; // Precio fijo por hora solicitado [1]

            // Sumamos las nuevas horas a las que ya tuviera acumuladas
            $nuevasHorasTotales = $reparacion->horas_trabajo + $request->horas;

            // Calculamos el coste total de la mano de obra acumulada
            $nuevoCosteManoObra = $nuevasHorasTotales * $precioPorHora;

            // El coste total de la reparación es: nueva mano de obra + piezas actuales
            $nuevoCosteTotal = $nuevoCosteManoObra + $reparacion->coste_total_piezas;

            // 4. Actualizar el registro en la base de datos
            $reparacion->update([
                'horas_trabajo'          => $nuevasHorasTotales,
                'coste_mano_obra'        => $nuevoCosteManoObra,
                'coste_total_reparacion' => $nuevoCosteTotal,
                // Opcional: si estaba 'pendiente', puedes pasar el estado a 'en proceso' de forma automática
                'estado'                 => $reparacion->estado === 'pendiente' ? 'en proceso' : $reparacion->estado
            ]);

            // 5. Respuesta de éxito
            return response()->json([
                'status'  => 'success',
                'message' => 'Horas añadidas y costes recalculados correctamente.',
                'data'    => [
                    'id_reparacion'          => $reparacion->id_reparacion,
                    'horas_añadidas'         => $request->horas,
                    'horas_totales'          => $reparacion->horas_trabajo,
                    'coste_mano_obra'        => $reparacion->coste_mano_obra,
                    'coste_total_piezas'     => $reparacion->coste_total_piezas,
                    'coste_total_reparacion' => $reparacion->coste_total_reparacion,
                    'estado'                 => $reparacion->estado
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al añadir las horas de trabajo.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

     public function getPiezasPorReparacion(Request $request)
    {
        // 1. Validar que se reciba el id de la reparación y exista en la base de datos
        $validator = Validator::make($request->all(), [
            'id_reparacion' => 'required|exists:reparaciones,id_reparacion',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            // 2. Buscar los registros de la tabla intermedia asociados a la reparación
            // Cargamos la relación 'pieza' para obtener los detalles de cada artículo
            $piezasAsignadas = \App\Models\ReparacionPieza::where('id_reparacion', $request->id_reparacion)
                ->with(['pieza' => function($query) {
                    $query->select('id_pieza', 'nombre_pieza', 'precio_venta');
                }])
                ->get();

            // 3. Controlar si la reparación aún no tiene ninguna pieza asignada
            if ($piezasAsignadas->isEmpty()) {
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Esta reparación aún no tiene piezas asignadas.',
                    'data'    => []
                ], 200);
            }

            // 4. Mapear y formatear la respuesta para que quede limpia y fácil de leer
            $resultado = $piezasAsignadas->map(function ($item) {
                return [
                    'id_registro'      => $item->id,
                    'id_pieza'         => $item->id_pieza,
                    'nombre_pieza'     => $item->pieza->nombre_pieza ?? 'Desconocida',
                    'precio_unitario'  => $item->pieza->precio_venta ?? 0.00,
                    'cantidad_usada'   => $item->cantidad_usada,
                    'subtotal_pieza'   => ($item->pieza->precio_venta ?? 0.00) * $item->cantidad_usada,
                    'id_mecanico_asig' => $item->id_usuario
                ];
            });

            // 5. Retornar la lista con el total de registros encontrados
            return response()->json([
                'status' => 'success',
                'count'  => $resultado->count(),
                'data'   => $resultado
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al obtener las piezas de la reparación.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }


    // Cambiar el estado de una reparación de forma dinámica
    public function cambiarEstado(Request $request)
    {
        // 1. Validar los datos de entrada (estados permitidos en tu taller)
        $validator = Validator::make($request->all(), [
            'id_reparacion' => 'required|exists:reparaciones,id_reparacion',
            'estado'        => 'required|string|in:pendiente,en proceso,finalizado',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            // 2. Buscar la reparación
            $reparacion = Reparacion::find($request->id_reparacion);
            $nuevoEstado = $request->input('estado');

            // Control de seguridad: si ya está finalizada, no se debería alterar su flujo normal
            if ($reparacion->estado === 'finalizado') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Esta reparación ya está finalizada y no se puede modificar su estado.'
                ], 400);
            }

            // 3. Caso Especial: Si el nuevo estado es 'finalizado', ejecutamos lógica de cobro y salida
            if ($nuevoEstado === 'finalizado') {
                if ($reparacion->coste_total_reparacion <= 0) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'No se puede finalizar una reparación con coste total de 0.00. Añade horas o piezas primero.'
                    ], 400);
                }

                $resultado = DB::transaction(function () use ($reparacion) {
                    // A. Actualizar reparación
                    $reparacion->update([
                        'estado'       => 'finalizado',
                        'fecha_salida' => now(),
                    ]);

                    // B. Sacar coche del taller
                    $coche = Coche::find($reparacion->id_coche);
                    if ($coche) {
                        $coche->update(['en_garaje' => 0]);
                    }

                    // C. Registrar ingreso en contabilidad
                    $ingreso = \App\Models\Contabilidad::create([
                        'tipo'       => 'ingreso',
                        'cantidad'   => $reparacion->coste_total_reparacion,
                        'concepto'   => "Cobro automático por finalización de reparación #" . $reparacion->id_reparacion,
                        'id_usuario' => $reparacion->id_mecanico,
                        'fecha'      => now(),
                    ]);

                    return $reparacion;
                });

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Reparación finalizada, coche retirado del taller e ingreso contabilizado.',
                    'data'    => $resultado
                ], 200);
            }

            // 4. Caso Común: Cambiar a 'pendiente' o 'en proceso'
            $reparacion->update(['estado' => $nuevoEstado]);

            return response()->json([
                'status'  => 'success',
                'message' => "El estado de la reparación ha cambiado a '{$nuevoEstado}' correctamente.",
                'data'    => [
                    'id_reparacion' => $reparacion->id_reparacion,
                    'nuevo_estado'  => $reparacion->estado
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al cambiar el estado de la reparación.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
