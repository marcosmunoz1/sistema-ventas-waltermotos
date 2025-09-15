<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('clientes')->insert([
            [
                'nombre_cliente' => 'Juan',
                'apellido_cliente' => 'Pérez',
                'cuit_cliente' => '20-12345678-9',
                'dni_cliente' => '12345678',
                'fecha_nacimiento_cliente' => '1985-05-10',
                'celular_cliente' => '+54 9 11 5555-1234',
                'email_cliente' => 'juan.perez@example.com',
                'estado_civil_cliente' => 'Casado',
                'id_conyugue_cliente' => 1, // Laura Martínez
                'calle' => 'Av. Corrientes 1234',
                'ciudad' => 'Buenos Aires',
                'provincia' => 'Buenos Aires',
                'profesion' => 'Contador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_cliente' => 'Carlos',
                'apellido_cliente' => 'Fernández',
                'cuit_cliente' => '20-33445566-7',
                'dni_cliente' => '33445566',
                'fecha_nacimiento_cliente' => '1980-01-15',
                'celular_cliente' => '+54 9 11 5555-9012',
                'email_cliente' => 'carlos.fernandez@example.com',
                'estado_civil_cliente' => 'Casado',
                'id_conyugue_cliente' => 2, // Sofía López
                'calle' => 'San Martín 456',
                'ciudad' => 'Rosario',
                'provincia' => 'Santa Fe',
                'profesion' => 'Ingeniero',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_cliente' => 'Diego',
                'apellido_cliente' => 'Ramírez',
                'cuit_cliente' => '20-55667788-4',
                'dni_cliente' => '55667788',
                'fecha_nacimiento_cliente' => '1990-03-20',
                'celular_cliente' => '+54 9 11 5555-7890',
                'email_cliente' => 'diego.ramirez@example.com',
                'estado_civil_cliente' => 'Casado',
                'id_conyugue_cliente' => 3, // Martín García
                'calle' => 'Belgrano 789',
                'ciudad' => 'Córdoba',
                'provincia' => 'Córdoba',
                'profesion' => 'Abogado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
