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
}
