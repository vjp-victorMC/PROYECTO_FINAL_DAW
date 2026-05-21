<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContabilidadSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contabilidad')->insert([
            ['id_transaccion' => 1,  'tipo' => 'ingreso', 'cantidad' => 250.00, 'fecha' => '2025-04-01 12:00:00', 'concepto' => 'Reparación Corolla',                                                              'id_usuario' => null],
            ['id_transaccion' => 2,  'tipo' => 'gasto',   'cantidad' => 100.00, 'fecha' => '2025-04-02 13:00:00', 'concepto' => 'Compra de pastillas de freno',                                                    'id_usuario' => 5],
            ['id_transaccion' => 3,  'tipo' => 'ingreso', 'cantidad' => 120.00, 'fecha' => '2025-04-03 16:45:00', 'concepto' => 'Sustitución batería Ford',                                                        'id_usuario' => null],
            ['id_transaccion' => 4,  'tipo' => 'gasto',   'cantidad' => 300.00, 'fecha' => '2025-04-04 14:00:00', 'concepto' => 'Compra piezas embrague',                                                         'id_usuario' => 5],
            ['id_transaccion' => 5,  'tipo' => 'ingreso', 'cantidad' => 150.00, 'fecha' => '2025-04-06 12:45:00', 'concepto' => 'Cambio amortiguadores Seat',                                                     'id_usuario' => null],
            ['id_transaccion' => 6,  'tipo' => 'gasto',   'cantidad' => 180.00, 'fecha' => '2025-04-07 11:30:00', 'concepto' => 'Aceite y filtros',                                                               'id_usuario' => 5],
            ['id_transaccion' => 7,  'tipo' => 'ingreso', 'cantidad' => 160.00, 'fecha' => '2025-04-08 13:00:00', 'concepto' => 'Reparación radiador Mercedes',                                                   'id_usuario' => null],
            ['id_transaccion' => 8,  'tipo' => 'ingreso', 'cantidad' => 160.00, 'fecha' => '2025-04-08 13:00:00', 'concepto' => 'Reparación radiador Mercedes',                                                   'id_usuario' => 1],
            ['id_transaccion' => 9,  'tipo' => 'gasto',   'cantidad' => 54.00,  'fecha' => '2025-04-16 00:00:00', 'concepto' => 'Compra de: piezaprueba Eliminar.',                                               'id_usuario' => 6],
            ['id_transaccion' => 10, 'tipo' => 'gasto',   'cantidad' => 120.00, 'fecha' => '2025-04-16 00:00:00', 'concepto' => 'Compra de: cachapon.',                                                           'id_usuario' => 5],
            ['id_transaccion' => 11, 'tipo' => 'gasto',   'cantidad' => 200.00, 'fecha' => '2025-04-17 00:00:00', 'concepto' => 'Compra de: Turbo.',                                                              'id_usuario' => 6],
            ['id_transaccion' => 12, 'tipo' => 'ingreso', 'cantidad' => 30.00,  'fecha' => '2025-04-25 14:12:50', 'concepto' => 'Reparación de coche 1234ABC, Cambio de aceite y filtro',                         'id_usuario' => 1],
            ['id_transaccion' => 13, 'tipo' => 'gasto',   'cantidad' => 10.00,  'fecha' => '2025-04-25 00:00:00', 'concepto' => 'Compra de: Termostato.',                                                        'id_usuario' => 22],
            ['id_transaccion' => 14, 'tipo' => 'gasto',   'cantidad' => 155.00, 'fecha' => '2025-04-25 00:00:00', 'concepto' => 'Compra de: Correa de distribución Amortiguador delantero Embrague.',             'id_usuario' => 22],
            ['id_transaccion' => 15, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-04-25 16:09:07', 'concepto' => 'Reparación de coche M1234YC, Motor roto',                                        'id_usuario' => 4],
            ['id_transaccion' => 16, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-04-25 16:09:46', 'concepto' => 'Reparación de coche 12313, asdad',                                               'id_usuario' => 6],
            ['id_transaccion' => 17, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-05 18:14:56', 'concepto' => "Reparación de coche 9802ftc, Termostato y mantenimiento \n",                     'id_usuario' => 6],
            ['id_transaccion' => 18, 'tipo' => 'ingreso', 'cantidad' => 150.00, 'fecha' => '2025-05-06 10:52:24', 'concepto' => 'Reparación de coche 2222ZZZ, Sustitución de amortiguadores',                     'id_usuario' => 7],
            ['id_transaccion' => 19, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-06 10:52:34', 'concepto' => "Reparación de coche Y0692CN, Liquido de direccion\n",                            'id_usuario' => 6],
            ['id_transaccion' => 20, 'tipo' => 'ingreso', 'cantidad' => 60.00,  'fecha' => '2025-05-06 10:53:27', 'concepto' => 'Reparación de coche 1121JKL, Revisión general',                                  'id_usuario' => 1],
            ['id_transaccion' => 21, 'tipo' => 'ingreso', 'cantidad' => 250.00, 'fecha' => '2025-05-06 10:53:31', 'concepto' => 'Reparación de coche 3141MNO, Cambio de embrague',                                'id_usuario' => 6],
            ['id_transaccion' => 22, 'tipo' => 'ingreso', 'cantidad' => 160.00, 'fecha' => '2025-05-06 10:53:33', 'concepto' => 'Reparación de coche 4444BBB, Fuga en radiador',                                  'id_usuario' => 1],
            ['id_transaccion' => 23, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-06 17:25:46', 'concepto' => "Reparación de coche a, a\n",                                                    'id_usuario' => 6],
            ['id_transaccion' => 24, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-06 18:26:27', 'concepto' => "Reparación de coche 6213MPV, Distribución \n",                                   'id_usuario' => 6],
            ['id_transaccion' => 28, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-06 18:34:00', 'concepto' => "Reparación de coche ma, ma\n",                                                   'id_usuario' => 6],
            ['id_transaccion' => 29, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-06 18:37:50', 'concepto' => "Reparación de coche 7341MYZ, Cambio de correa de distribución.\nCambio de las ruedas delanteras.", 'id_usuario' => 6],
            ['id_transaccion' => 32, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 12:41:55', 'concepto' => "Reparación de coche 1111VBX, Cambio de ruedas",                                  'id_usuario' => 6],
            ['id_transaccion' => 36, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 13:02:16', 'concepto' => 'Reparación de coche 1231aaa, Cambio de ruedas',                                  'id_usuario' => 6],
            ['id_transaccion' => 38, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 13:10:39', 'concepto' => 'Reparación de coche 111VBX, Cambio de aceite',                                   'id_usuario' => 6],
            ['id_transaccion' => 39, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 14:50:55', 'concepto' => "Reparación de coche 1234ASD, Hola\n",                                            'id_usuario' => 6],
            ['id_transaccion' => 40, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 14:50:59', 'concepto' => 'Reparación de coche 0674GWK, a',                                                 'id_usuario' => 6],
            ['id_transaccion' => 41, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 14:51:03', 'concepto' => 'Reparación de coche 6407Gwk, a',                                                 'id_usuario' => 6],
            ['id_transaccion' => 42, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 14:53:38', 'concepto' => "Reparación de coche a, a\n",                                                    'id_usuario' => 6],
            ['id_transaccion' => 43, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 14:55:32', 'concepto' => "Reparación de coche a, a\n",                                                    'id_usuario' => 6],
            ['id_transaccion' => 44, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 14:58:21', 'concepto' => "Reparación de coche a, a\n",                                                    'id_usuario' => 6],
            ['id_transaccion' => 45, 'tipo' => 'ingreso', 'cantidad' => 60.00,  'fecha' => '2025-05-07 15:13:15', 'concepto' => 'Reparación de coche 1121JKL, Revisión general',                                  'id_usuario' => 1],
            ['id_transaccion' => 47, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 16:23:55', 'concepto' => 'Reparación de coche 1121JKL, ',                                                  'id_usuario' => 6],
            ['id_transaccion' => 48, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 16:46:05', 'concepto' => 'Reparación de coche a, a',                                                       'id_usuario' => 6],
            ['id_transaccion' => 49, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 16:47:39', 'concepto' => "Reparación de coche a, a\n",                                                    'id_usuario' => 6],
            ['id_transaccion' => 50, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 16:50:22', 'concepto' => "Reparación de coche a, a\n",                                                    'id_usuario' => 6],
            ['id_transaccion' => 51, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-07 17:14:11', 'concepto' => "Reparación de coche 1234FML, Coche choque\n",                                    'id_usuario' => 6],
            ['id_transaccion' => 52, 'tipo' => 'ingreso', 'cantidad' => 250.00, 'fecha' => '2025-05-09 12:31:30', 'concepto' => 'Reparación de coche 3183LMP, Cambio de la correa de distribución.',              'id_usuario' => 6],
            ['id_transaccion' => 53, 'tipo' => 'ingreso', 'cantidad' => 180.00, 'fecha' => '2025-05-09 12:41:10', 'concepto' => 'Reparación de coche 1111DMG, Cambio de direccion',                               'id_usuario' => 6],
            ['id_transaccion' => 54, 'tipo' => 'ingreso', 'cantidad' => 1140.00,'fecha' => '2025-05-10 16:48:04', 'concepto' => "Reparación de coche 0674GWK, Cambio de inyectores\nCambio de la rotula de direccion\nCambio de termostato\n", 'id_usuario' => 6],
            ['id_transaccion' => 55, 'tipo' => 'ingreso', 'cantidad' => 100.00, 'fecha' => '2025-05-14 16:31:31', 'concepto' => 'Reparación de coche 640765703, Cambio de ruedas',                                'id_usuario' => 6],
            ['id_transaccion' => 56, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-14 16:32:40', 'concepto' => 'Reparación de coche 0764GWK , ',                                                 'id_usuario' => 6],
            ['id_transaccion' => 57, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-14 18:29:02', 'concepto' => 'Reparación de coche 0762GWK, ',                                                  'id_usuario' => 6],
            ['id_transaccion' => 58, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-14 18:38:00', 'concepto' => 'Reparación de coche b123, Reparacion de prueba',                                 'id_usuario' => 6],
            ['id_transaccion' => 59, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-14 18:43:21', 'concepto' => 'Reparación de coche 1234AAA, Motor',                                             'id_usuario' => 6],
            ['id_transaccion' => 60, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-14 18:50:32', 'concepto' => 'Reparación de coche 1234AAA, Puerta trasera',                                    'id_usuario' => 6],
            ['id_transaccion' => 61, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-15 07:43:39', 'concepto' => 'Reparación de coche 1637MVN, ja',                                                'id_usuario' => 6],
            ['id_transaccion' => 62, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-15 07:55:22', 'concepto' => 'Reparación de coche 8888AAA, Puerta trasera',                                    'id_usuario' => 6],
            ['id_transaccion' => 63, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-15 08:07:17', 'concepto' => 'Reparación de coche 7777AAA, Volante, reparacion2',                              'id_usuario' => 6],
            ['id_transaccion' => 64, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-15 08:14:52', 'concepto' => 'Reparación de coche 1234AAA, Luna, Sol',                                         'id_usuario' => 6],
            ['id_transaccion' => 65, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-15 08:18:51', 'concepto' => 'Reparación de coche 55555XXX, airbag',                                           'id_usuario' => 6],
            ['id_transaccion' => 66, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-15 08:18:58', 'concepto' => 'Reparación de coche 5555XXX, Volante, Luna',                                     'id_usuario' => 6],
            ['id_transaccion' => 67, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-15 19:29:47', 'concepto' => 'Reparación de coche 0000PPP, prueba',                                            'id_usuario' => 6],
            ['id_transaccion' => 68, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-15 19:29:51', 'concepto' => 'Reparación de coche 8888PPP, Airbag',                                            'id_usuario' => 6],
            ['id_transaccion' => 69, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-15 19:29:55', 'concepto' => 'Reparación de coche prueba, esto es una prueba',                                 'id_usuario' => 6],
            ['id_transaccion' => 70, 'tipo' => 'ingreso', 'cantidad' => 100.00, 'fecha' => '2025-05-15 19:33:42', 'concepto' => 'Reparación de coche prueba2, prueba2',                                           'id_usuario' => 6],
            ['id_transaccion' => 71, 'tipo' => 'ingreso', 'cantidad' => 0.00,   'fecha' => '2025-05-15 19:35:22', 'concepto' => 'Reparación de coche prueba3, prueba 3',                                          'id_usuario' => 6],
        ]);
    }
}
