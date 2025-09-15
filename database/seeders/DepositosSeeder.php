<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepositosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('depositos')->insert([
            [
                'nombre_deposito' => 'Deposito principal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_deposito' => 'Deposito secundario',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
