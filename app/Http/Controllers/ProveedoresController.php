<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('admin.proveedores.index', compact('proveedores'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        return view('admin.proveedores.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_proveedor' => 'required',
            'cuit' => 'required|string|max:255',
            'telefono' => 'required',
            'celular' => 'required',
            'email' => 'nullable'
        ]);

        $proveedor = New Proveedor();
        $proveedor->nombre_proveedor = $request->nombre_proveedor;
        $proveedor->cuit = $request->cuit;
        $proveedor->telefono = $request->telefono;
        $proveedor->celular = $request->celular;
        $proveedor->email = $request->email;
        $proveedor->estado_proveedor = 1;
        $proveedor->save();

        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'El proveedor se agrego con exíto')
            ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Proveedor::destroy($id);
        return redirect()->route('admin.proveedores.index')
        ->with('mensaje','Se elimino el proveedor exitosamente')
        ->with('icono','success');
    }
}
