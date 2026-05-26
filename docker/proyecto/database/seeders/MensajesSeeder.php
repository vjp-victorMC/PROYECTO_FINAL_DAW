<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MensajesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mensajes')->insert([
            [
                'usuario_envio' => 4, // Carlos Ruiz (Cliente)
                'usuario_recibo' => 6, // admin
                'matricula' => '1234FML',
                'asunto' => 'Solicitar Presupuesto',
                'mensaje' => 'Hola, noto un ruido extraño al frenar. ¿Cuándo puedo llevar el coche?',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'usuario_envio' => 1, // Juan Pérez (Mecánico)
                'usuario_recibo' => 6, // admin
                'matricula' => '1111DMG',
                'asunto' => 'Confirmación de cita',
                'mensaje' => 'Hola Carlos, puedes traerlo mañana a las 10:00 AM.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'usuario_envio' => 6, // admin
                'usuario_recibo' => 6, // admin
                'matricula' => '1234FML',
                'asunto' => 'Asignación de nueva tarea',
                'mensaje' => 'Sofía, te he asignado la reparación del coche con matrícula 1234XYZ.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
