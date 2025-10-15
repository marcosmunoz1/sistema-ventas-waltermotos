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
        DB::table('marcas')->insert(['nombre_marca' => 'Honda']);
        DB::table('marcas')->insert(['nombre_marca' => 'Yamaha']);
        DB::table('marcas')->insert(['nombre_marca' => 'Suzuki']);
        DB::table('marcas')->insert(['nombre_marca' => 'Kawasaki']);
        DB::table('marcas')->insert(['nombre_marca' => 'Ducati']);
        DB::table('marcas')->insert(['nombre_marca' => 'BMW']);
        DB::table('marcas')->insert(['nombre_marca' => 'KTM']);
        DB::table('marcas')->insert(['nombre_marca' => 'Harley-Davidson']);
        DB::table('marcas')->insert(['nombre_marca' => 'Triumph']);
        DB::table('marcas')->insert(['nombre_marca' => 'Aprilia']);
    }
}
