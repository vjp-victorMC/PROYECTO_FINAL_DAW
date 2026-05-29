<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\Http\Request;

class CocheController extends Controller
{
    // Guardar un nuevo coche
    public function setNewCar(Request $request)
    {
        $request->validate([
            'matricula'          => 'required|unique:coches,matricula|max:20',
            'marca'              => 'required|string|max:50',
            'modelo'             => 'required|string|max:50',
            'km'                 => 'required|integer',
            'combustible'        => 'required|string|max:30',
            'transmision'        => 'required|string|max:30',
            'anio_matriculacion' => 'required|digits:4',
            'id_usuario'         => 'required|exists:usuarios,id_usuario',
            'imagen'             => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('coches', 'public');
        }

        Coche::create([
            'matricula'          => $request->matricula,
            'marca'              => $request->marca,
            'modelo'             => $request->modelo,
            'km'                 => $request->km,
            'combustible'        => $request->combustible,
            'transmision'        => $request->transmision,
            'anio_matriculacion' => $request->anio_matriculacion,
            'id_usuario'         => $request->id_usuario,
            'imagen'             => $path,
            'en_garaje'          => 0,
        ]);

        return back()->with('success', 'Coche registrado con éxito.');
    }

    // Ver todos los vehículos de un usuario específico
    public function carByUserId($id_usuario)
    {
        $coches = Coche::where('id_usuario', $id_usuario)->get();

        return view('coches.index', compact('coches'));
    }

    // Devuelve los coches de un usuario en formato JSON (matrícula y modelo)
    public function getUsuarioCars($id_usuario)
    {
        $coches = \App\Models\Coche::where('id_usuario', $id_usuario)
            ->get(['matricula', 'modelo']);
        return response()->json($coches);
    }

    public function getCochesEnGaraje()
    {
        // 1. Consultar los coches filtrando por el estado en_garaje
        $coches = Coche::where('en_garaje', 1)->get();

        // 2. Retornar la respuesta en formato JSON
        return response()->json([
            'status'  => 'success',
            'count'   => $coches->count(),
            'data'    => $coches
        ], 200);
    }

    public function getCochesParaPagar()
    {
        // Buscamos los coches que están en el garaje (en_garaje = 1)
        // Y que tienen al menos una relación con reparaciones en estado 'finalizada'
        $coches = Coche::where('en_garaje', 1)
            ->whereHas('reparaciones', function ($query) {
                $query->where('estado', 'finalizada');
            })
            ->get();

        return response()->json([
            'status'  => 'success',
            'count'   => $coches->count(),
            'data'    => $coches
        ], 200);
    }

    public function getDetalleVehiculo($id_coche)
    {
        // 1. Buscamos el coche por su ID cargando el usuario y solo la última reparación
        $coche = Coche::with([
            'usuario',
            'reparaciones' => function ($query) {
                $query->latest('id_reparacion')->first();
            }
        ])->find($id_coche);

        // 2. Si el coche no existe, devolvemos un error 404
        if (!$coche) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Vehículo no encontrado.'
            ], 404);
        }

        // 3. Modificamos la colección para que devuelva "ultima_reparacion" como un objeto directo en vez de un array
        $cocheData = $coche->toArray();

        // Extraemos la última reparación si existe
        $ultimaReparacion = $coche->reparaciones->first();

        // Reestructuramos la respuesta JSON para que sea limpia
        unset($cocheData['reparaciones']);
        $cocheData['ultima_reparacion'] = $ultimaReparacion ? $ultimaReparacion : null;

        // 4. Retornamos la respuesta con éxito
        return response()->json([
            'status' => 'success',
            'data'   => $cocheData
        ], 200);
    }

    public function getIdPorMatricula($matricula)
    {
        // 1. Buscamos el coche por su matrícula y seleccionamos solo el ID
        $coche = Coche::where('matricula', $matricula)->first(['id_coche']);

        // 2. Si el coche no existe, devolvemos un error 404
        if (!$coche) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Vehículo con esa matrícula no encontrado.'
            ], 404);
        }

        // 3. Retornamos directamente el ID del coche
        return response()->json([
            'status'   => 'success',
            'id_coche' => $coche->id_coche
        ], 200);
    }

}
