<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ], [
            'name.required' => 'El nombre de rol es obligatorio.',
            'name.unique' => 'El Rol ya está registrado.'
        ]);
        $rol = Role::find($id);
        $rol->name = $request->name;
        $rol->guard_name = "web";

        $rol->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'El Rol actualizado con exíto')
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
            } elseif (stripos($permiso->name, 'config') !== false) {
                return 'Sistema';
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
        //$datos = $request->all();
        //return response()->json($datos, 200, [], JSON_PRETTY_PRINT); 

        $request->validate([
            'permisos' => 'required|array',
        ]);

        $rol = Role::find($id);
        $rol->permissions()->sync($request->input('permisos'));

        return redirect()->back()
            ->with('mensaje', 'Se asignaron los permisos para el rol de manera correcta')
            ->with('icono', 'success');
    }


    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Se elimino el Rol con exíto')
            ->with('icono', 'success');
    }
}
