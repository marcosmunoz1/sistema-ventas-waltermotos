<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Lista de permisos
        $permisos = [
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

        // Crear permisos
        foreach ($permisos as $permiso) {
            Permission::firstOrCreate($permiso);
        }

        // Crear rol Super-Admin y asignarle todos los permisos
        $superAdminRole = Role::firstOrCreate(['name' => 'Super-Admin']);
        $superAdminRole->syncPermissions(Permission::all());

        // Crear usuario Super-Admin y asignarle el rol
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@developer.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('123456789'),
            ]
        );
        $superAdmin->assignRole($superAdminRole);

        $this->command->info('Super-Admin creado con todos los permisos');
    }
}
