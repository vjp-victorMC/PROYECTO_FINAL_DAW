<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    // 1. Crear un nuevo proveedor
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'telefono' => 'required|string|max:15',
            'email'    => 'required|email|max:100|unique:proveedores,email',
        ]);

        $proveedor = Proveedor::create($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Proveedor registrado con éxito.',
            'data'    => $proveedor
        ], 201);
    }

    // 2. Obtener todos los proveedores
    public function index()
    {
        $proveedores = Proveedor::all();

        return response()->json([
            'status' => 'success',
            'count'  => $proveedores->count(),
            'data'   => $proveedores
        ], 200);
    }

    // 3. Obtener un proveedor específico por su ID
    public function show($id_proveedor)
    {
        $proveedor = Proveedor::find($id_proveedor);

        if (!$proveedor) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Proveedor no encontrado.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $proveedor
        ], 200);
    }

    // 4. Actualizar los datos de un proveedor
    public function update(Request $request, $id_proveedor)
    {
        $proveedor = Proveedor::find($id_proveedor);

        if (!$proveedor) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Proveedor no encontrado.'
            ], 404);
        }

        $request->validate([
            'nombre'   => 'sometimes|required|string|max:100',
            'telefono' => 'sometimes|required|string|max:15',
            'email'    => 'sometimes|required|email|max:100|unique:proveedores,email,' . $id_proveedor . ',id_proveedor',
        ]);

        $proveedor->update($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Datos del proveedor actualizados.',
            'data'    => $proveedor
        ], 200);
    }

    // 5. Eliminar un proveedor
    public function destroy($id_proveedor)
    {
        $proveedor = Proveedor::find($id_proveedor);

        if (!$proveedor) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Proveedor no encontrado.'
            ], 404);
        }

        // Al borrarlo, las piezas asociadas pondrán su 'id_proveedor' a null automáticamente por la migración onDelete('set null')
        $proveedor->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Proveedor eliminado correctamente.'
        ], 200);
    }

    // 6. Obtener todas las piezas suministradas por un proveedor concreto
    public function getPiezasByProveedor($id_proveedor)
    {
        $proveedor = Proveedor::with('piezas')->find($id_proveedor);

        if (!$proveedor) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Proveedor no encontrado.'
            ], 404);
        }

        return response()->json([
            'status'    => 'success',
            'proveedor' => $proveedor->nombre,
            'count'     => $proveedor->piezas->count(),
            'data'      => $proveedor->piezas
        ], 200);
    }
}
