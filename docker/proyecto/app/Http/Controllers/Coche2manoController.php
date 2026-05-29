<?php

namespace App\Http\Controllers;

use App\Models\Coche2Mano;
use App\Models\Contabilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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


    //Metodo para añadir un nuevo coche de 2 mano
    public function storeCoche2Mano(Request $request)
    {
        // 1. Validamos los datos recibidos
        $request->validate([
            'matricula'        => 'required|string|max:20|unique:vehiculo2mano,matricula',
            'marca'            => 'required|string|max:50',
            'modelo'           => 'required|string|max:50',
            'imagen'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Máximo 2MB
            'precio'           => 'required|numeric|min:0',
            'especificaciones' => 'nullable|string',
            'km'               => 'required|integer|min:0',
        ]);

        // 2. Gestionamos la subida de la imagen si se ha enviado una
        $path = null;
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('coches2mano', 'public');
        }

        // 3. Insertamos el nuevo registro en la base de datos
        $coche = Coche2Mano::create([
            'matricula'        => $request->matricula,
            'marca'            => $request->marca,
            'modelo'           => $request->modelo,
            'imagen'           => $path,
            'precio'           => $request->precio,
            'especificaciones' => $request->especificaciones,
            'km'               => $request->km,
        ]);

        // 4. Retornamos la respuesta (para API JSON o vista)
        if ($request->wantsJson()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Vehículo de segunda mano registrado con éxito.',
                'data'    => $coche
            ], 201);
        }

        return back()->with('success', 'Vehículo de segunda mano registrado con éxito.');
    }

     public function retirarDelTaller($id)
    {
        // Buscamos el coche por su ID primario de Laravel (id)
        $coche = Coche2Mano::find($id);

        if (!$coche) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Vehículo de segunda mano no encontrado.'
            ], 404);
        }

        // Si el coche tiene una imagen guardada, la borramos del disco public
        if ($coche->imagen) {
            Storage::disk('public')->delete($coche->imagen);
        }

        // Eliminamos el registro de la tabla
        $coche->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'El vehículo ha sido retirado del taller correctamente.'
        ], 200);
    }

    public function venderCoche(Request $request, $id)
    {
        // Validamos opcionalmente si nos pasan el id del usuario que realiza la venta
        $request->validate([
            'id_usuario' => 'nullable|exists:usuarios,id_usuario'
        ]);

        $coche = Coche2Mano::find($id);

        if (!$coche) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Vehículo de segunda mano no encontrado.'
            ], 404);
        }

        // Usamos una transacción de BD: si algo falla, no se borra el coche ni se mete dinero fantasma
        DB::transaction(function () use ($coche, $request) {

            // Creamos el ingreso en la tabla contabilidad.
            // Esto disparará automáticamente el evento 'created' de tu modelo Contabilidad,
            // sumando el importe en la tabla 'saldo_taller'.
            Contabilidad::create([
                'tipo'       => 'ingreso',
                'cantidad'   => $coche->precio,
                'concepto'   => "Venta de vehículo de ocasión: {$coche->marca} {$coche->modelo} ({$coche->matricula})",
                'id_usuario' => $request->id_usuario,
                'fecha'      => now(),
            ]);

            // Borramos la imagen del almacenamiento físico
            if ($coche->imagen) {
                Storage::disk('public')->delete($coche->imagen);
            }

            // Eliminamos el vehículo de la base de datos
            $coche->delete();
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Vehículo vendido con éxito. El dinero ha sido ingresado en las cajas del taller.'
        ], 200);
    }
}
