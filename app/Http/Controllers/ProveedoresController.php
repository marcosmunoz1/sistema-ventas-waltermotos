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

        return redirect($request->redirect_to)
            ->with('mensaje', 'El proveedor se agrego con exíto')
            ->with('icono', 'success');

    }

    public function crearProveedorCompra(Request $request)
    {
        $request->validate([
            'nombre_proveedor' => 'required|string|max:100',
            'cuit' => 'required|string|max:20|unique:proveedores,cuit',
            'telefono' => 'required|string|max:50',
            'celular' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:proveedores,email'
        ]);

        $proveedor = Proveedor::create([
            'nombre_proveedor' => $request->nombre_proveedor,
            'cuit' => $request->cuit,
            'telefono' => $request->telefono,
            'celular' => $request->celular,
            'email' => $request->email,
            'estado_proveedor' => 1 // o el valor que quieras por defecto
        ]);


        return response()->json([
            'id' => $proveedor->id,
            'nombre' => $proveedor->nombre_proveedor
        ]);
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
