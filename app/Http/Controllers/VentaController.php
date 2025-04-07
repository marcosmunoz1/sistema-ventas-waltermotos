<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Marca;
use App\Models\Moto;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('moto','cliente')->get();
        return view('admin.ventas.index', compact('ventas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $motos = Moto::whereNull('fecha_venta_moto')->get();
        $clientes = Cliente::with('conyugue')->get();
        $marcas = Marca::all();
        return view('admin.ventas.create', compact('clientes', 'motos', 'marcas'));
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
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
