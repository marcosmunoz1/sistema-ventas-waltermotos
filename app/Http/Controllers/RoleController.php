<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::where('name', '!=', 'SuperAdmin')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles'
        ], [
            'name.required' => 'El nombre de rol es obligatorio.',
            'name.unique' => 'El Rol ya está registrado.'
        ]);


        $rol = new Role();
        $rol->name = $request->name;
        $rol->guard_name = "web";

        $rol->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'El Rol se cargo con exíto')
            ->with('icono', 'success');
    }

    public function edit($id)
    {
        $rol = Role::find($id);
        return view('/admin/roles/edit', compact('rol'));
    }

    public function update(Request $request, $id)
    {
        $rol = Role::findOrFail($id);

        /** @var \App\Models\User $userLogueado */
        $userLogueado = Auth::user();

        // 🚫 Bloquear edición si es Super-Admin y quien edita no es Super-Admin
        if (strtolower($rol->name) === 'super-admin' && !optional($userLogueado)->hasRole('Super-Admin')) {
            return redirect()->back()
                ->with('mensaje', 'No podés editar el rol Super-Admin 🚫')
                ->with('icono', 'error');
        }

        // Validación
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ], [
            'name.required' => 'El nombre de rol es obligatorio.',
            'name.unique' => 'El Rol ya está registrado.'
        ]);

        // Actualizar rol
        $rol->name = $request->name;
        $rol->guard_name = "web";
        $rol->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'El Rol actualizado con éxito ✅')
            ->with('icono', 'success');
    }

    public function asignar($id)
    {
        $rol = Role::find($id);

        $permisos = Permission::all()->groupBy(function ($permiso) {
            if (stripos($permiso->name, 'usu') !== false) {
                return 'Usuarios';
            } elseif (stripos($permiso->name, 'rol') !== false) {
                return 'Roles';
            } elseif (stripos($permiso->name, 'perm') !== false || stripos($permiso->name, 'per') !== false) {
                return 'Permisos';
            } elseif (stripos($permiso->name, 'cli') !== false) {
                return 'Clientes';
            } elseif (stripos($permiso->name, 'prov') !== false) {
                return 'Proveedores';
            } elseif (stripos($permiso->name, 'comp') !== false) {
                return 'Compras';
            } elseif (stripos($permiso->name, 'cred') !== false) {
                return 'Creditos';
            } elseif (stripos($permiso->name, 'vent') !== false) {
                return 'Ventas';
            } elseif (stripos($permiso->name, 'comp') !== false) {
                return 'Compras';
            } elseif (stripos($permiso->name, 'mar') !== false) {
                return 'Marcas';
            } elseif (stripos($permiso->name, 'mot') !== false) {
                return 'Motos';
            }
        })->map(function ($grupo) {
            return $grupo->sortBy('name');
        });

        // Dividir los permisos dentro de cada grupo en partes de 10
        $permisosDivididos = $permisos->map(function ($grupo) {
            return $grupo->chunk(10); // Divide cada grupo en subgrupos de 10 permisos
        });

        return view('admin.roles.asignar', compact('rol', 'permisosDivididos', 'permisos'));
    }


    public function update_asignar(Request $request, $id)
    {
        $request->validate([
            'permisos' => 'required|array',
        ]);

        // Encontrar el rol
        $rol = Role::findOrFail($id);

        /** @var \App\Models\User $userLogueado */
        $userLogueado = Auth::user();

        //Bloquear cambios si el rol es Super-Admin y quien edita no lo es
        if (strtolower($rol->name) === 'super-admin' && !optional($userLogueado)->hasRole('Super-Admin')) {
            return redirect()->back()
                ->with('mensaje', 'No podés modificar los permisos del rol Super-Admin 🚫')
                ->with('icono', 'error');
        }

        // Sincronizar permisos
        $rol->permissions()->sync($request->input('permisos'));

        // Limpiar cache de permisos de Spatie
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // Refrescar a todos los usuarios que tengan ese rol
        foreach ($rol->users as $user) {
            $user->refresh(); // recarga relaciones y permisos en memoria
        }

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Permisos creados para el Rol')
            ->with('descripcion', 'Se asignaron los permisos para el rol de manera correcta.')
            ->with('icono', 'success');
    }




    public function destroy($id)
    {
        $rol = Role::findOrFail($id);

        // Si el rol a eliminar es "Super-Admin"
        if ($rol->name === 'Super-Admin') {
            // Solo lo puede eliminar un usuario con el rol Super-Admin
            if (!Auth::user()->hasRole('Super-Admin')) {
                return redirect()->route('admin.roles.index')
                    ->with('mensaje', '❌ Solo el Super-Admin puede eliminar este rol')
                    ->with('icono', 'error');
            }
        }

        $rol->delete();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', '✅ Se eliminó el Rol con éxito')
            ->with('icono', 'success');
    }
}
