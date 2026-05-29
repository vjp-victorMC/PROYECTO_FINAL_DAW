<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use App\Models\Contabilidad;
use App\Models\SaldoTaller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContabilidadController extends Controller
{
    // Registrar un nuevo ingreso o gasto
    public function store(Request $request)
    {
        $request->validate([
            'tipo'       => 'required|in:ingreso,gasto',
            'cantidad'   => 'required|numeric|min:0.01',
            'concepto'   => 'required|string|max:255',
            'id_usuario' => 'nullable|exists:usuarios,id_usuario',
        ]);

        // Usamos una transacción de Base de Datos por seguridad y consistencia
        $transaccion = DB::transaction(function () use ($request) {
            return Contabilidad::create([
                'tipo'       => $request->tipo,
                'cantidad'   => $request->cantidad,
                'concepto'   => $request->concepto,
                'id_usuario' => $request->id_usuario,
                'fecha'      => now(),
            ]);
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Transacción registrada y saldo actualizado con éxito.',
            'data'    => $transaccion
        ], 201);
    }

    // Obtener el saldo actual del taller y el historial básico
    public function getEstadoFinanciero()
    {
        $saldoActual = SaldoTaller::find(1);
        $ultimosMovimientos = Contabilidad::latest('id_transaccion')->take(10)->get();

        return response()->json([
            'status' => 'success',
            'caja'   => [
                'saldo_total'         => $saldoActual ? $saldoActual->saldo : 0.00,
                'ultima_actualizacion' => $saldoActual ? $saldoActual->ultima_actualizacion : null,
            ],
            'ultimos_movimientos' => $ultimosMovimientos
        ], 200);
    }


    public function getDashboardData(Request $request)
    {
        // Evaluamos el año solicitado o tomamos el año actual por defecto
        $anio = $request->get('anio', date('Y'));

        // 1. CÁLCULO DE LAS TARJETAS SUPERIORES
        // Facturado este año (Suma de todos los ingresos del año)
        $facturado = Contabilidad::where('tipo', 'ingreso')
            ->whereYear('fecha', $anio)
            ->sum('cantidad');

        // Gastos este año (Suma de todos los gastos del año)
        $gastos = Contabilidad::where('tipo', 'gasto')
            ->whereYear('fecha', $anio)
            ->sum('cantidad');

        // Margen bruto (Diferencia entre ingresos y gastos)
        $margenBruto = $facturado - $gastos;

        // Porcentaje de ingresos consumido por los gastos
        $porcentajeGastos = $facturado > 0 ? round(($gastos / $facturado) * 100, 1) : 0;

        // Coches atendidos este año (Métrica basada en tu tabla de coches/reparaciones)
        // Contamos los coches que tienen reparaciones finalizadas o registradas en este año
        $cochesAtendidos = Coche::whereHas('reparaciones', function ($query) use ($anio) {
            $query->whereYear('fecha_entrada', $anio);
        })->count();


        // 2. CÁLCULO DE LAS GRÁFICAS
        $driver = DB::getDriverName();
        $yearExpr = $driver === 'sqlite'
            ? "CAST(strftime('%Y', fecha) AS INTEGER)"
            : 'YEAR(fecha)';
        $reparacionYearExpr = $driver === 'sqlite'
            ? "CAST(strftime('%Y', fecha_entrada) AS INTEGER)"
            : 'YEAR(fecha_entrada)';
        $monthExpr = $driver === 'sqlite'
            ? "CAST(strftime('%m', fecha) AS INTEGER)"
            : 'MONTH(fecha)';
        $reparacionMonthExpr = $driver === 'sqlite'
            ? "CAST(strftime('%m', fecha_entrada) AS INTEGER)"
            : 'MONTH(fecha_entrada)';

        // Totales anuales para todos los años disponibles
        $datosGastosAnios = Contabilidad::selectRaw("{$yearExpr} as anio, SUM(cantidad) as total")
            ->where('tipo', 'gasto')
            ->groupBy('anio')
            ->orderBy('anio')
            ->pluck('total', 'anio');

        $datosCochesAnios = DB::table('reparaciones')
            ->selectRaw("{$reparacionYearExpr} as anio, COUNT(DISTINCT id_coche) as total")
            ->groupBy('anio')
            ->orderBy('anio')
            ->pluck('total', 'anio');

        $yearKeys = collect(array_merge(array_keys($datosGastosAnios->toArray()), array_keys($datosCochesAnios->toArray())))
            ->map(fn($year) => (int)$year)
            ->unique()
            ->sort()
            ->values()
            ->all();

        $gastosAnuales = array_fill_keys($yearKeys, 0);
        $cochesAnuales = array_fill_keys($yearKeys, 0);

        foreach ($datosGastosAnios as $anioDb => $total) {
            $gastosAnuales[(int)$anioDb] = round($total, 2);
        }
        foreach ($datosCochesAnios as $anioDb => $total) {
            $cochesAnuales[(int)$anioDb] = (int)$total;
        }

        // Datos mensuales del año seleccionado
        $gastosMensuales = array_fill(1, 12, 0);
        $cochesMensuales = array_fill(1, 12, 0);

        $datosGastosDb = Contabilidad::selectRaw("{$monthExpr} as mes, SUM(cantidad) as total")
            ->where('tipo', 'gasto')
            ->whereYear('fecha', $anio)
            ->groupBy('mes')
            ->pluck('total', 'mes');

        foreach ($datosGastosDb as $mes => $total) {
            $gastosMensuales[$mes] = round($total, 2);
        }

        $datosCochesDb = DB::table('reparaciones')
            ->selectRaw("{$reparacionMonthExpr} as mes, COUNT(DISTINCT id_coche) as total")
            ->whereYear('fecha_entrada', $anio)
            ->groupBy('mes')
            ->pluck('total', 'mes');

        foreach ($datosCochesDb as $mes => $total) {
            $cochesMensuales[$mes] = (int)$total;
        }


        // 3. ESTRUCTURA DE RESPUESTA LIMPIA PARA EL FRONTEND
        return response()->json([
            'status' => 'success',
            'anio_consultado' => (int)$anio,
            'tarjetas' => [
                'facturado_anio' => [
                    'valor_crudo' => $facturado,
                    'valor_formateado' => '€' . number_format($facturado / 1000, 1) . 'k'
                ],
                'gastos_anio' => [
                    'valor_crudo' => $gastos,
                    'valor_formateado' => '€' . number_format($gastos / 1000, 1) . 'k',
                    'porcentaje_de_ingresos' => $porcentajeGastos . '%'
                ],
                'coches_atendidos' => [
                    'total' => $cochesAtendidos
                ],
                'margen_bruto' => [
                    'valor_crudo' => $margenBruto,
                    'valor_formateado' => '€' . number_format($margenBruto / 1000, 1) . 'k'
                ]
            ],
            'graficas' => [
                'etiquetas_anios' => array_values($yearKeys),
                'gastos_por_anio' => array_values($gastosAnuales),
                'coches_por_anio' => array_values($cochesAnuales),
                'etiquetas_meses' => ['E', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
                'gastos_por_mes'  => array_values($gastosMensuales),
                'coches_por_mes'  => array_values($cochesMensuales),
            ]
        ], 200);
    }

}
