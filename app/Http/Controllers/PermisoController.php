<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $permisos = Permission::orderBy('name', 'asc')->get();

        
        return view('admin.permisos.index', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.permisos.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datos = $request->all();
        //return response()->json($datos, 200, [], JSON_PRETTY_PRINT);

        $request->validate([
            'name' => 'required|unique:permissions,name'
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'El nombre ya esta registrado.'
        ]);
        
        
        $permiso = new Permission();
        $permiso->name = $request->name;
        $permiso->save();

        return redirect()->route('admin.permisos.index')
            ->with('mensaje', 'Permiso registrado con exíto')
            ->with('icono', 'success'); 

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $permiso = Permission::find($id);
        return view('admin.permisos.show', compact('permiso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $permiso = Permission::find($id);
        return view('/admin/permisos/edit', compact('permiso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'El nombre ya esta registrado.'
        ]);
        
        $permiso = Permission::find($id);
        $permiso->name = $request->name;
        $permiso->save();

        return redirect()->route('admin.permisos.index')
            ->with('mensaje', 'Permiso Actualizado con exíto')
            ->with('icono', 'success'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Permission::destroy($id);
        return redirect()->route('admin.permisos.index')
            ->with('mensaje', 'Se elimino el Permiso con exíto')
            ->with('icono','success');
    }
}
