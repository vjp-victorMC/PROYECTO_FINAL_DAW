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

}
