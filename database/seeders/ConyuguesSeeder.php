<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConyuguesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('conyugues')->insert([
            [
                'nombre_conyugue' => 'Laura',
                'apellido_conyugue' => 'Martínez',
                'dni_conyugue' => '32145000',
                'fecha_nacimiento_conyugue' => '1987-04-12',
                'celular_conyugue' => '+54 9 11 5555-1111',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_conyugue' => 'Sofía',
                'apellido_conyugue' => 'López',
                'dni_conyugue' => '34567890',
                'fecha_nacimiento_conyugue' => '1992-11-30',
                'celular_conyugue' => '+54 9 11 5555-2222',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_conyugue' => 'Martín',
                'apellido_conyugue' => 'García',
                'dni_conyugue' => '29816543',
                'fecha_nacimiento_conyugue' => '1985-07-08',
                'celular_conyugue' => '+54 9 11 5555-3333',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_conyugue' => 'Manuel',
                'apellido_conyugue' => 'Morales',
                'dni_conyugue' => '30876525',
                'fecha_nacimiento_conyugue' => '1987-06-23',
                'celular_conyugue' => '+54 9 11 5555-4444',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_conyugue' => 'Yesica',
                'apellido_conyugue' => 'Vera',
                'dni_conyugue' => '30876333',
                'fecha_nacimiento_conyugue' => '1988-06-15',
                'celular_conyugue' => '+54 9 11 5555-5555',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
