<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Clientes::all();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipoCampo = DB::selectOne("SHOW COLUMNS FROM clientes WHERE Field = 'estado_civil_cliente'");

        // Extraer los valores del enum del string: enum('soltero','casado','divorciado','viudo')
        preg_match("/^enum\((.*)\)$/", $tipoCampo->Type, $matches);

        $valores = [];
        if (!empty($matches)) {
            $valores = str_getcsv($matches[1], ',', "'");
        }
        return view('admin.clientes.create', compact('valores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
}
