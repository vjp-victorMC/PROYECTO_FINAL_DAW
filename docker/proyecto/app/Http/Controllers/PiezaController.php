<?php

namespace App\Http\Controllers;

use App\Models\Pieza;
use App\Models\Contabilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PiezaController extends Controller
{
    // 1. Crear una nueva pieza en el catálogo
    public function store(Request $request)
    {
        $request->validate([
            'nombre_pieza'        => 'required|string|max:100',
            'cantidad_disponible' => 'nullable|integer|min:0',
            'precio_compra'       => 'required|numeric|min:0',
            'precio_venta'        => 'required|numeric|min:0',
            'stock_minimo'        => 'nullable|integer|min:0',
            'id_proveedor'        => 'nullable|exists:proveedores,id_proveedor',
        ]);

        $pieza = Pieza::create($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Pieza añadida al catálogo con éxito.',
            'data'    => $pieza
        ], 201);
    }

    // 2. Obtener todas las piezas
    public function index()
    {
        $piezas = Pieza::all();

        return response()->json([
            'status' => 'success',
            'count'  => $piezas->count(),
            'data'   => $piezas
        ], 200);
    }

    // 3. Comprar unidades de una pieza (Aumenta stock y genera Gasto en contabilidad)
    public function comprarPieza(Request $request, $id_pieza)
    {
        $request->validate([
            'cantidad'   => 'required|integer|min:1',
            'id_usuario' => 'nullable|exists:usuarios,id_usuario', // Quién hace la compra
        ]);

        $pieza = Pieza::find($id_pieza);

        if (!$pieza) {
            return response()->json([
                'status'  => 'error',
                'message' => 'La pieza no existe en el catálogo.'
            ], 404);
        }

        $unidades = $request->cantidad;
        $costeTotal = $pieza->precio_compra * $unidades;

        // Ejecutamos en transacción para asegurar consistencia
        DB::transaction(function () use ($pieza, $unidades, $costeTotal, $request) {
            // Aumentamos el stock físico de la pieza
            $pieza->increment('cantidad_disponible', $unidades);

            // Registramos el gasto en contabilidad (esto resta saldo automáticamente)
            Contabilidad::create([
                'tipo'       => 'gasto',
                'cantidad'   => $costeTotal,
                'concepto'   => "Compra de stock: {$unidades}x {$pieza->nombre_pieza}",
                'id_usuario' => $request->id_usuario,
                'fecha'      => now(),
            ]);
        });

        return response()->json([
            'status'  => 'success',
            'message' => "Compra registrada. Se han añadido {$unidades} unidades y generado un gasto de {$costeTotal}€.",
            'data'    => $pieza->fresh() // Devuelve la pieza con el stock actualizado
        ], 200);
    }

    // 4. Obtener las piezas por debajo del stock mínimo
    public function getBajoStockMinimo()
    {
        // Compara directamente la columna de stock con su columna de límite mínimo
        $piezasAlerta = Pieza::whereColumn('cantidad_disponible', '<', 'stock_minimo')->get();

        return response()->json([
            'status' => 'success',
            'count'  => $piezasAlerta->count(),
            'data'   => $piezasAlerta
        ], 200);
    }

    // 5. Obtener el NÚMERO total de piezas que NO tienen stock (cantidad = 0)
    public function getCountSinStock()
    {
        $totalSinStock = Pieza::where('cantidad_disponible', 0)->count();

        return response()->json([
            'status' => 'success',
            'total_sin_stock' => $totalSinStock
        ], 200);
    }
}
