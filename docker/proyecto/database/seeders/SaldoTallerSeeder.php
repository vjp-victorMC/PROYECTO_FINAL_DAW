<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaldoTallerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('saldo_taller')->insert([
            ['id' => 1, 'saldo' => 12101.00, 'ultima_actualizacion' => '2025-05-15 19:35:22'],
        ]);
    }
}
