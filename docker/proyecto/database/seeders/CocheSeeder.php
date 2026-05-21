<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CocheSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('coches')->insert([
            [
                'id_coche' => 33,
                'matricula' => '1234FML',
                'marca' => 'Citroen',
                'modelo' => 'C4',
                'km' => 120000,
                'combustible' => 'Diesel',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2018,
                'id_usuario' => 1,
                'imagen' => 'https://citroen-ausol.com/wp-content/uploads/2023/01/c4x-1.jpg',
                'en_garaje' => false
            ],
            [
                'id_coche' => 34,
                'matricula' => '3183LMP',
                'marca' => 'Citroen',
                'modelo' => 'C4 Puretech',
                'km' => 45000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2021,
                'id_usuario' => 4,
                'imagen' => 'https://citroen-ausol.com/wp-content/uploads/2023/01/c4x-1.jpg',
                'en_garaje' => false
            ],
            [
                'id_coche' => 35,
                'matricula' => '1111DMG',
                'marca' => 'Volkswagen',
                'modelo' => 'Golf IV',
                'km' => 280000,
                'combustible' => 'Diesel',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2003,
                'id_usuario' => 5,
                'imagen' => 'https://www.tuning.es/358576-large_default/anadido-rdx-vw-golf-4.jpg',
                'en_garaje' => false
            ],
            [
                'id_coche' => 36,
                'matricula' => '0674GWK',
                'marca' => 'Volkswagen',
                'modelo' => 'Golf 6',
                'km' => 160000,
                'combustible' => 'Diesel',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2011,
                'id_usuario' => 6,
                'imagen' => 'https://www.automocionpere.com/storage/app/uploads/public/vehiculos/2358/volkswagen_golf_gti_gt_vr6_g60_rallye_rolling_stones_pink_floyd_manhattan_automocionpere_001.jpg',
                'en_garaje' => false
            ],
            [
                'id_coche' => 37,
                'matricula' => '2222AAA',
                'marca' => 'Seat',
                'modelo' => 'Ibiza',
                'km' => 100000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2015,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 38,
                'matricula' => '3333BBB',
                'marca' => 'Renault',
                'modelo' => 'Clio',
                'km' => 90000,
                'combustible' => 'Diesel',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2016,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 39,
                'matricula' => '4444CCC',
                'marca' => 'Ford',
                'modelo' => 'Focus',
                'km' => 80000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2017,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 40,
                'matricula' => '5555DDD',
                'marca' => 'Peugeot',
                'modelo' => '308',
                'km' => 70000,
                'combustible' => 'Diesel',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2018,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 41,
                'matricula' => '6666EEE',
                'marca' => 'Opel',
                'modelo' => 'Astra',
                'km' => 60000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2019,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 42,
                'matricula' => '7777FFF',
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'km' => 50000,
                'combustible' => 'Híbrido',
                'transmision' => 'Automático',
                'anio_matriculacion' => 2020,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 49,
                'matricula' => '8888GGG',
                'marca' => 'Kia',
                'modelo' => 'Ceed',
                'km' => 40000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2021,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 50,
                'matricula' => '9999HHH',
                'marca' => 'Mazda',
                'modelo' => '3',
                'km' => 30000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2022,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 51,
                'matricula' => '1010III',
                'marca' => 'Hyundai',
                'modelo' => 'i30',
                'km' => 20000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2023,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 52,
                'matricula' => '1111JJJ',
                'marca' => 'Fiat',
                'modelo' => 'Punto',
                'km' => 10000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2024,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 53,
                'matricula' => '1212KKK',
                'marca' => 'Honda',
                'modelo' => 'Civic',
                'km' => 5000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2025,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 54,
                'matricula' => '1313LLL',
                'marca' => 'Nissan',
                'modelo' => 'Micra',
                'km' => 4000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2025,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 55,
                'matricula' => '1414MMM',
                'marca' => 'Suzuki',
                'modelo' => 'Swift',
                'km' => 3000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2025,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 56,
                'matricula' => '1515NNN',
                'marca' => 'Dacia',
                'modelo' => 'Sandero',
                'km' => 2000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2025,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 57,
                'matricula' => '1616OOO',
                'marca' => 'Mini',
                'modelo' => 'Cooper',
                'km' => 1000,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2025,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 58,
                'matricula' => '1717PPP',
                'marca' => 'BMW',
                'modelo' => 'Serie 1',
                'km' => 500,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2025,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
            [
                'id_coche' => 59,
                'matricula' => '1818QQQ',
                'marca' => 'Mercedes',
                'modelo' => 'Clase A',
                'km' => 100,
                'combustible' => 'Gasolina',
                'transmision' => 'Manual',
                'anio_matriculacion' => 2025,
                'id_usuario' => 4,
                'imagen' => null,
                'en_garaje' => false
            ],
        ]);
    }
}
