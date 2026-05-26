<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Coche2manoSeeder  extends Seeder
{
    public function run(): void
    {
        DB::table('vehiculo2mano')->insert([
            [
                'matricula' => '1234BBB',
                'marca' => 'Toyota',
                'modelo' => 'Yaris',
                'imagen' => 'https://kobemotor.es/wp-content/uploads/2024/05/Toyota-GR-Yaris-2024.jpg',
                'precio' => 12500.00,
                'anio_matriculacion' =>2022,
                'motorizacion'=>'Hibrido',
                'especificaciones' => 'Híbrido, etiqueta ECO, cámara trasera, un solo dueño.',
                'km' => 45000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'matricula' => '5678CCC',
                'marca' => 'Volkswagen',
                'modelo' => 'Golf',
                'imagen' => 'https://alz-motors.es/wp-content/uploads/2021/01/VOLKSWAGEN-Golf-GTI-Clubsport.jpg',
                'precio' => 18900.00,
                'anio_matriculacion' =>20218,
                'motorizacion'=>'Gasolina',
                'especificaciones' => 'Diesel, cambio automático DSG, techo solar, revisión recién pasada.',
                'km' => 82000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'matricula' => '9012DDD',
                'marca' => 'Ford',
                'modelo' => 'Focus',
                'imagen' => 'https://hips.hearstapps.com/es.h-cdn.co/cades/contenidos/52502/ford_focus_rs2.png',
                'precio' => 9500.50,
                'anio_matriculacion' =>2010,
                'motorizacion'=>'Gasolina',
                'especificaciones' => 'Gasolina, manual, Bluetooth, climatizador bizona.',
                'km' => 110000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
