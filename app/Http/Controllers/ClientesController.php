<?php

namespace App\Http\Controllers;
use App\Enums\EstadoCivil;

use App\Models\Cliente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $valores = EstadoCivil::cases(); // Devuelve un array de objetos EstadoCivil
        return view('admin.clientes.create', compact('valores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = $request->all();
        //return response()->json($datos);
        $request->validate([
            'nombre_cliente' => 'required',
            'apellido_cliente' => 'required',
            'cuit_cliente' => 'required|unique:clientes,cuit_cliente',
            'dni_cliente' => 'required|unique:clientes,dni_cliente',
            'fecha_nacimiento_cliente' => 'required',
            'celular_cliente' => 'required',
            'email_cliente' => 'required|email|unique:clientes,email_cliente',
            'estado_civil_cliente' => 'required',
            'id_conyugue_cliente' => 'nullable',
            'calle' => 'required',
            'ciudad' => 'required',
            'provincia' => 'required',
            'profesion' => 'required'

        ]);

        $cliente = New Cliente();
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->apellido_cliente = $request->apellido_cliente;
        $cliente->cuit_cliente = $request->cuit_cliente;
        $cliente->dni_cliente = $request->dni_cliente;
        $cliente->fecha_nacimiento_cliente = $request->fecha_nacimiento_cliente;
        $cliente->celular_cliente = $request->celular_cliente;
        $cliente->email_cliente = $request->email_cliente;
        $cliente->estado_civil_cliente = $request->estado_civil_cliente;
        $cliente->email_cliente = $request->email_cliente;
        $cliente->id_conyugue_cliente = $request->id_conyugue_cliente;
        $cliente->calle = $request->calle;
        $cliente->ciudad = $request->ciudad;
        $cliente->provincia = $request->provincia;
        $cliente->profesion = $request->profesion;

        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'El cliente se agregó con exíto')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $clientes)
    {
        //
    }
}
