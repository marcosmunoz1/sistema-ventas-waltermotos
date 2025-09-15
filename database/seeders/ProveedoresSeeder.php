<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('proveedores')->insert([
            [
                'nombre_proveedor' => 'Distribuidora La Cordial',
                'cuit' => '30-12345678-9',
                'telefono' => '011-4321-5678',
                'celular' => '11-6543-2109',
                'email' => 'contacto@lacordial.com',
                'estado_proveedor' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_proveedor' => 'Motosur S.A.',
                'cuit' => '30-98765432-1',
                'telefono' => '0291-456-7890',
                'celular' => '291-654-9870',
                'email' => 'ventas@motosur.com',
                'estado_proveedor' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_proveedor' => 'Repuestos del Norte',
                'cuit' => '20-11112222-3',
                'telefono' => '0381-432-2211',
                'celular' => '381-765-4433',
                'email' => 'info@repuestosnorte.com',
                'estado_proveedor' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_proveedor' => 'Lubricantes Premium SRL',
                'cuit' => '30-22223333-4',
                'telefono' => '0341-456-7788',
                'celular' => '341-665-7788',
                'email' => 'ventas@lubpremium.com',
                'estado_proveedor' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_proveedor' => 'Importadora Andina',
                'cuit' => '30-33334444-5',
                'telefono' => '0261-432-9988',
                'celular' => '261-543-2211',
                'email' => 'importadora@andina.com',
                'estado_proveedor' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_proveedor' => 'Electro Motos',
                'cuit' => '20-44445555-6',
                'telefono' => '0362-445-1234',
                'celular' => '362-777-1122',
                'email' => 'contacto@electromotos.com',
                'estado_proveedor' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_proveedor' => 'Frenos y Más',
                'cuit' => '27-55556666-7',
                'telefono' => '0343-412-3344',
                'celular' => '343-889-2233',
                'email' => 'ventas@frenosymas.com',
                'estado_proveedor' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_proveedor' => 'Neumáticos del Plata',
                'cuit' => '30-66667777-8',
                'telefono' => '0221-421-5566',
                'celular' => '221-334-5566',
                'email' => 'info@neumaticosplata.com',
                'estado_proveedor' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_proveedor' => 'Distribuidora Patagónica',
                'cuit' => '20-77778888-9',
                'telefono' => '0299-421-7788',
                'celular' => '299-664-1122',
                'email' => 'ventas@patagonica.com',
                'estado_proveedor' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_proveedor' => 'Central de Repuestos',
                'cuit' => '23-88889999-0',
                'telefono' => '011-4789-3344',
                'celular' => '11-9988-7766',
                'email' => 'contacto@centralrepuestos.com',
                'estado_proveedor' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
