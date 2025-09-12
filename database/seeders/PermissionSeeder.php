<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'configuracion-del-sistema'],
        
            ['name' => 'usuarios-ver'],
            ['name' => 'usuarios-crear'],
            ['name' => 'usuarios-editar'],
            ['name' => 'usuarios-eliminar'],
        
            ['name' => 'roles-ver'],
            ['name' => 'roles-crear'],
            ['name' => 'roles-editar'],
            ['name' => 'roles-eliminar'],
             ['name' => 'roles-asignar'],
        
            ['name' => 'permisos-ver'],
            ['name' => 'permisos-crear'],
            ['name' => 'permisos-editar'],
            ['name' => 'permisos-eliminar'],
        
            ['name' => 'clientes-ver'],
            ['name' => 'clientes-crear'],
            ['name' => 'clientes-editar'],
            ['name' => 'clientes-eliminar'],
        
            ['name' => 'proveedores-ver'],
            ['name' => 'proveedores-crear'],
            ['name' => 'proveedores-editar'],
            ['name' => 'proveedores-eliminar'],
        
            ['name' => 'motos-ver'],
            ['name' => 'motos-crear'],
            ['name' => 'motos-editar'],
            ['name' => 'motos-eliminar'],
        
            ['name' => 'ventas-ver'],
            ['name' => 'ventas-crear'],
            ['name' => 'ventas-editar'],
            ['name' => 'ventas-eliminar'],
        
            ['name' => 'compras-ver'],
            ['name' => 'compras-crear'],
            ['name' => 'compras-editar'],
            ['name' => 'compras-eliminar'],
        
            ['name' => 'creditos-ver'],
            ['name' => 'creditos-crear'],
            ['name' => 'creditos-editar'],
            ['name' => 'creditos-eliminar'],
        ];
        

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $permission['name']],
                [
                    'name' => $permission['name'],
                    'guard_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
