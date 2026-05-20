<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('proveedores')->insert([
            ['id_proveedor' => 1,  'nombre' => 'Repuestos Martínez',    'telefono' => '910000001', 'email' => 'contacto@repmartinez.com'],
            ['id_proveedor' => 2,  'nombre' => 'Autopartes del Sur',     'telefono' => '910000002', 'email' => 'ventas@autosur.com'],
            ['id_proveedor' => 3,  'nombre' => 'Componentes López',      'telefono' => '910000003', 'email' => 'info@comlopez.com'],
            ['id_proveedor' => 4,  'nombre' => 'Motorparts España',      'telefono' => '910000004', 'email' => 'soporte@motorparts.es'],
            ['id_proveedor' => 5,  'nombre' => 'Repuestos Extremadura',  'telefono' => '927123456', 'email' => 'pedidos@repex.com'],
            ['id_proveedor' => 6,  'nombre' => 'EuroRecambios',          'telefono' => '910000005', 'email' => 'clientes@eurorecambios.es'],
            ['id_proveedor' => 7,  'nombre' => 'Distribuciones Rueda',   'telefono' => '910000006', 'email' => 'contacto@rueda.com'],
            ['id_proveedor' => 8,  'nombre' => 'Tallerpieces',           'telefono' => '910000007', 'email' => 'info@tallerpieces.com'],
            ['id_proveedor' => 9,  'nombre' => 'Grupo MotorPro',         'telefono' => '910000008', 'email' => 'ventas@motorpro.com'],
            ['id_proveedor' => 10, 'nombre' => 'Recambios Exprés',       'telefono' => '910000009', 'email' => 'soporte@recambiosx.com'],
            ['id_proveedor' => 13, 'nombre' => 'pruebaproveedor',        'telefono' => '640987654', 'email' => 'pruebaproveedor@gmail.com'],
            ['id_proveedor' => 14, 'nombre' => 'adrianino',              'telefono' => '654874797', 'email' => 'adrian@putoamo.es'],
        ]);
    }
}
