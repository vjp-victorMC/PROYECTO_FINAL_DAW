<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PiezaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('piezas')->insert([
            ['id_pieza' => 1,  'nombre_pieza' => 'Filtro de aceite',        'cantidad_disponible' => 3,  'precio_compra' => 5.00,   'precio_venta' => 10.00,  'stock_minimo' => 5,  'id_proveedor' => 1],
            ['id_pieza' => 2,  'nombre_pieza' => 'Pastillas de freno',      'cantidad_disponible' => 8,  'precio_compra' => 15.00,  'precio_venta' => 30.00,  'stock_minimo' => 5,  'id_proveedor' => 2],
            ['id_pieza' => 3,  'nombre_pieza' => 'Batería 70Ah',            'cantidad_disponible' => 8,  'precio_compra' => 60.00,  'precio_venta' => 90.00,  'stock_minimo' => 3,  'id_proveedor' => 3],
            ['id_pieza' => 4,  'nombre_pieza' => 'Correa de distribución',  'cantidad_disponible' => 11, 'precio_compra' => 30.00,  'precio_venta' => 55.00,  'stock_minimo' => 5,  'id_proveedor' => 4],
            ['id_pieza' => 5,  'nombre_pieza' => 'Amortiguador delantero',  'cantidad_disponible' => 6,  'precio_compra' => 45.00,  'precio_venta' => 80.00,  'stock_minimo' => 2,  'id_proveedor' => 5],
            ['id_pieza' => 6,  'nombre_pieza' => 'Embrague',                'cantidad_disponible' => 5,  'precio_compra' => 80.00,  'precio_venta' => 150.00, 'stock_minimo' => 1,  'id_proveedor' => 6],
            ['id_pieza' => 7,  'nombre_pieza' => 'Aceite 5W30 5L',          'cantidad_disponible' => 15, 'precio_compra' => 20.00,  'precio_venta' => 35.00,  'stock_minimo' => 5,  'id_proveedor' => 7],
            ['id_pieza' => 8,  'nombre_pieza' => 'Radiador',                'cantidad_disponible' => 5,  'precio_compra' => 55.00,  'precio_venta' => 100.00, 'stock_minimo' => 3,  'id_proveedor' => 8],
            ['id_pieza' => 9,  'nombre_pieza' => 'Espejo retrovisor',       'cantidad_disponible' => 9,  'precio_compra' => 25.00,  'precio_venta' => 45.00,  'stock_minimo' => 2,  'id_proveedor' => 9],
            ['id_pieza' => 10, 'nombre_pieza' => 'Inyector diésel',         'cantidad_disponible' => 0,  'precio_compra' => 90.00,  'precio_venta' => 140.00, 'stock_minimo' => 2,  'id_proveedor' => 10],
            ['id_pieza' => 11, 'nombre_pieza' => 'Turbo',                   'cantidad_disponible' => 3,  'precio_compra' => 200.00, 'precio_venta' => 320.00, 'stock_minimo' => 2,  'id_proveedor' => 10],
            ['id_pieza' => 12, 'nombre_pieza' => 'Sensor ABS',              'cantidad_disponible' => 7,  'precio_compra' => 18.00,  'precio_venta' => 32.00,  'stock_minimo' => 3,  'id_proveedor' => 4],
            ['id_pieza' => 13, 'nombre_pieza' => 'Rotula de dirección',     'cantidad_disponible' => 12, 'precio_compra' => 15.00,  'precio_venta' => 17.00,  'stock_minimo' => 10, 'id_proveedor' => 9],
            ['id_pieza' => 14, 'nombre_pieza' => 'Termostato',              'cantidad_disponible' => 11, 'precio_compra' => 10.00,  'precio_venta' => 18.00,  'stock_minimo' => 5,  'id_proveedor' => 5],
            ['id_pieza' => 15, 'nombre_pieza' => 'Eliminar',                'cantidad_disponible' => 6,  'precio_compra' => 6.00,   'precio_venta' => 7.00,   'stock_minimo' => 5,  'id_proveedor' => 10],
            ['id_pieza' => 16, 'nombre_pieza' => 'piezaprueba',             'cantidad_disponible' => 2,  'precio_compra' => 15.00,  'precio_venta' => 10.00,  'stock_minimo' => 1,  'id_proveedor' => 13],
            ['id_pieza' => 17, 'nombre_pieza' => 'cachapon',                'cantidad_disponible' => 10, 'precio_compra' => 12.00,  'precio_venta' => 15.00,  'stock_minimo' => 3,  'id_proveedor' => 14],
        ]);
    }
}
