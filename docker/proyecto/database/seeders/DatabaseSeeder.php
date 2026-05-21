<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsuarioSeeder::class,          // sin dependencias
            ProveedorSeeder::class,        // sin dependencias
            Coche2manoSeeder::class,        // sin dependencias
            CocheSeeder::class,            // depende de: clientes
            PiezaSeeder::class,            // depende de: proveedores
            ReparacionSeeder::class,       // depende de: coches, usuarios
            ReparacionPiezaSeeder::class,  // depende de: reparaciones, piezas, usuarios
            ContabilidadSeeder::class,     // depende de: usuarios
            SaldoTallerSeeder::class,      // sin dependencias
        ]);
    }
}
