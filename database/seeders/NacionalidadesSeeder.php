<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NacionalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nacionalidades')->insert([
            [
                'pais' => 'Argentina',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pais' => 'Brasil',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pais' => 'Chile',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pais' => 'Paraguay',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pais' => 'Uruguay',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
