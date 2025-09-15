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
        DB::table('marcas')->insert([
            ['nombre_marca' => 'Honda',       'created_at' => now(), 'updated_at' => now()],
            ['nombre_marca' => 'Yamaha',      'created_at' => now(), 'updated_at' => now()],
            ['nombre_marca' => 'Suzuki',      'created_at' => now(), 'updated_at' => now()],
            ['nombre_marca' => 'Kawasaki',    'created_at' => now(), 'updated_at' => now()],
            ['nombre_marca' => 'Ducati',      'created_at' => now(), 'updated_at' => now()],
            ['nombre_marca' => 'Harley-Davidson', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_marca' => 'BMW',         'created_at' => now(), 'updated_at' => now()],
            ['nombre_marca' => 'KTM',         'created_at' => now(), 'updated_at' => now()],
            ['nombre_marca' => 'Triumph',     'created_at' => now(), 'updated_at' => now()],
            ['nombre_marca' => 'Royal Enfield', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
