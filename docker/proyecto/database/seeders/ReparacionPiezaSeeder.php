<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReparacionPiezaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reparaciones_piezas')->insert([
            ['id' => 8,  'id_reparacion' => 43, 'id_pieza' => 1,  'cantidad_usada' => 5,  'id_usuario' => 6],
            ['id' => 9,  'id_reparacion' => 44, 'id_pieza' => 1,  'cantidad_usada' => 2,  'id_usuario' => 6],
            ['id' => 10, 'id_reparacion' => 44, 'id_pieza' => 2,  'cantidad_usada' => 2,  'id_usuario' => 6],
            ['id' => 11, 'id_reparacion' => 45, 'id_pieza' => 10, 'cantidad_usada' => 3,  'id_usuario' => 6],
            ['id' => 12, 'id_reparacion' => 45, 'id_pieza' => 1,  'cantidad_usada' => 1,  'id_usuario' => 6],
            ['id' => 13, 'id_reparacion' => 45, 'id_pieza' => 1,  'cantidad_usada' => 1,  'id_usuario' => 6],
            ['id' => 14, 'id_reparacion' => 45, 'id_pieza' => 1,  'cantidad_usada' => 10, 'id_usuario' => 6],
            ['id' => 15, 'id_reparacion' => 46, 'id_pieza' => 5,  'cantidad_usada' => 1,  'id_usuario' => 6],
        ]);
    }
}
