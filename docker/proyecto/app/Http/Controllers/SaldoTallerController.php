<?php

namespace App\Http\Controllers;

use App\Models\SaldoTaller;
use Illuminate\Http\JsonResponse;

class SaldoTallerController extends Controller
{
    /**
     * Obtiene el saldo actual del taller (ID 1).
     */
    public function obtenerSaldo(): JsonResponse
    {
        // Busca el ID 1 o lo crea con saldo 0 si la tabla está vacía
        $saldoTaller = SaldoTaller::firstOrCreate(
            ['id' => 1],
            ['saldo' => 0.00]
        );

        return response()->json([
            'success' => true,
            'saldo' => $saldoTaller->saldo
        ], 200);
    }
}
