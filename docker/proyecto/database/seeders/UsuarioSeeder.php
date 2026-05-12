<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->insert([
            ['id_usuario' => 1, 'nombre' => 'Juan Pérez', 'email' => 'juan.perez@example.com', 'contraseña' => 'pass123', 'rol' => 'mecanico'],
            ['id_usuario' => 4, 'nombre' => 'Carlos Ruiz', 'email' => 'carlos.ruiz@example.com', 'contraseña' => 'pass123', 'rol' => 'cliente'],
            ['id_usuario' => 5, 'nombre' => 'Sofía Martín', 'email' => 'sofia.martin@example.com', 'contraseña' => 'pass123', 'rol' => 'mecanico'],
            ['id_usuario' => 6, 'nombre' => 'admin', 'email' => 'admin2@email.com', 'contraseña' => 'admin', 'rol' => 'admin'],
            ['id_usuario' => 7, 'nombre' => 'Rubén González', 'email' => 'ruben.gonzalez@example.com', 'contraseña' => 'pass123', 'rol' => 'admin'],
            ['id_usuario' => 8, 'nombre' => 'Laura Romero', 'email' => 'laura.romero@example.com', 'contraseña' => 'pass123', 'rol' => 'mecanico'],
            ['id_usuario' => 9, 'nombre' => 'Tomás Sánchez', 'email' => 'tomas.sanchez@example.com', 'contraseña' => 'pass123', 'rol' => 'mecanico'],
            ['id_usuario' => 22, 'nombre' => 'david', 'email' => 'david@gmail.com', 'contraseña' => 'pass123', 'rol' => 'admin'],
        ]);
    }
}
