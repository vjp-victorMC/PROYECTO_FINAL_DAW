<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('clientes')->insert([
            ['id_cliente' => 27, 'nombre' => 'Aitor',        'dni' => '49366651A', 'telefono' => '640765703', 'email' => null],
            ['id_cliente' => 28, 'nombre' => 'Marta Ester',  'dni' => '42381934G', 'telefono' => '642154870', 'email' => 'matapablo23@gmail.com'],
            ['id_cliente' => 29, 'nombre' => 'David',        'dni' => '49367756G', 'telefono' => '649153609', 'email' => 'david@gmail.com'],
            ['id_cliente' => 30, 'nombre' => 'a',            'dni' => 'a',         'telefono' => '4',         'email' => 'a'],
            ['id_cliente' => 33, 'nombre' => 'David',        'dni' => '12341234G', 'telefono' => '123456789', 'email' => 'quitar3@gmail.com'],
            ['id_cliente' => 34, 'nombre' => 'David',        'dni' => '12345678G', 'telefono' => '649153609', 'email' => 'david2@gmail.com'],
            ['id_cliente' => 35, 'nombre' => 'David',        'dni' => '11111111G', 'telefono' => '111111111', 'email' => 'david@gmail.com'],
            ['id_cliente' => 36, 'nombre' => 'Mario',        'dni' => '55555555Q', 'telefono' => '555555555', 'email' => 'mario@gmail.com'],
            ['id_cliente' => 37, 'nombre' => 'aa',           'dni' => 'aa',        'telefono' => '22',        'email' => 're'],
            ['id_cliente' => 38, 'nombre' => 'prueba',       'dni' => '123123',    'telefono' => '123123',    'email' => 'prueba@gmail.com'],
            ['id_cliente' => 39, 'nombre' => 'prueba2',      'dni' => '22222222',  'telefono' => '22222222',  'email' => 'prueba2@gmail.com'],
            ['id_cliente' => 40, 'nombre' => 'prueba 3',     'dni' => '3333333333','telefono' => '3333333333','email' => 'prueba3@gmail.com'],
        ]);
    }
}
