<?php

namespace App\Traits;

use Spatie\Permission\PermissionRegistrar;

trait AutoRefreshPermissions
{
    public static function bootAutoRefreshPermissions()
    {
        // Se ejecuta después de guardar un usuario, rol o permiso
        static::saved(function ($model) {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
        });

        // Se ejecuta después de eliminar un usuario, rol o permiso
        static::deleted(function ($model) {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
        });
    }
}
