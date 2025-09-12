<?php

namespace App\Observers;

use Spatie\Permission\PermissionRegistrar;

class RolePermissionObserver
{
    public function saved($model)
    {
        // Limpiar cache de roles y permisos
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function deleted($model)
    {
        // Limpiar cache de roles y permisos si se elimina algo
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
