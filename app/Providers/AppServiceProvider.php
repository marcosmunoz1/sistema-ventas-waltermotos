<?php

namespace App\Providers;

use App\Observers\RolePermissionObserver;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Role::observe(RolePermissionObserver::class);
        Permission::observe(RolePermissionObserver::class);
    }
}
