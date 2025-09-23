<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marcas')->truncate(); // vacía la tabla antes de insertar

        $marcas = [
            ['nombre_marca' => 'Honda'],
            ['nombre_marca' => 'Yamaha'],
            ['nombre_marca' => 'Suzuki'],
            ['nombre_marca' => 'Kawasaki'],
            ['nombre_marca' => 'Ducati'],
            ['nombre_marca' => 'BMW'],
            ['nombre_marca' => 'KTM'],
            ['nombre_marca' => 'Harley-Davidson'],
            ['nombre_marca' => 'Triumph'],
            ['nombre_marca' => 'Aprilia'],
        ];

        DB::table('marcas')->insert($marcas);
    }
}
