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
                'pais' => 'Brasilera',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pais' => 'Japonesa',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pais' => 'China',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pais' => 'Italiana',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
