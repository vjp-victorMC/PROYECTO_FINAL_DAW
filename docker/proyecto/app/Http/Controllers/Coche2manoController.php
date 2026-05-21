<?php

namespace App\Http\Controllers;

use App\Models\Coche2Mano;
use Illuminate\Http\Request;

class Coche2manoController extends Controller
{
    // Método para devolver todos los coches
    public function getAll2HandCar()
    {
        $vehiculos = Coche2Mano::all();

        return response()->json([
            'success' => true,
            'data' => $vehiculos
        ], 200);
    }

    // Método para añadir un coche de segunda mano
    public function setNew2HandCar(Request $request)
    {
        $request->validate([
            'matricula'        => 'required|unique:vehiculo2mano,matricula|max:20',
            'marca'            => 'required|string|max:50',
            'modelo'           => 'required|string|max:50',
            'precio'           => 'required|numeric',
            'km'               => 'required|integer',
            'especificaciones' => 'nullable|string',
            'imagen'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('vehiculos_ocasion', 'public');
        }

        $vehiculo = Coche2Mano::create([
            'matricula'        => $request->matricula,
            'marca'            => $request->marca,
            'modelo'           => $request->modelo,
            'precio'           => $request->precio,
            'km'               => $request->km,
            'especificaciones' => $request->especificaciones,
            'imagen'           => $path,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Vehículo de ocasión registrado',
            'data' => $vehiculo
        ], 201);
    }
}
