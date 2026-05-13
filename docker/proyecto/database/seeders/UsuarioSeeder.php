<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->insert([
            ['id_usuario' => 1, 'nombre' => 'Juan Pérez', 'email' => 'juan.perez@example.com', 'dni' => '00000001A', 'contraseña' => Hash::make('pass123'), 'rol' => 'mecanico'],
            ['id_usuario' => 4, 'nombre' => 'Carlos Ruiz', 'email' => 'carlos.ruiz@example.com', 'dni' => '00000002B', 'contraseña' => Hash::make('pass123'), 'rol' => 'cliente'],
            ['id_usuario' => 5, 'nombre' => 'Sofía Martín', 'email' => 'sofia.martin@example.com', 'dni' => '00000003C', 'contraseña' => Hash::make('pass123'), 'rol' => 'mecanico'],
            ['id_usuario' => 6, 'nombre' => 'admin', 'email' => 'admin2@email.com', 'dni' => '00000004D', 'contraseña' => Hash::make('admin'), 'rol' => 'admin'],
            ['id_usuario' => 7, 'nombre' => 'Rubén González', 'email' => 'ruben.gonzalez@example.com', 'dni' => '00000005E', 'contraseña' => Hash::make('pass123'), 'rol' => 'admin'],
            ['id_usuario' => 8, 'nombre' => 'Laura Romero', 'email' => 'laura.romero@example.com', 'dni' => '00000006F', 'contraseña' => Hash::make('pass123'), 'rol' => 'mecanico'],
            ['id_usuario' => 9, 'nombre' => 'Tomás Sánchez', 'email' => 'tomas.sanchez@example.com', 'dni' => '00000007G', 'contraseña' => Hash::make('pass123'), 'rol' => 'mecanico'],
            ['id_usuario' => 22, 'nombre' => 'david', 'email' => 'david@gmail.com', 'dni' => '00000008H', 'contraseña' => Hash::make('pass123'), 'rol' => 'admin'],
        ]);
    }
}
