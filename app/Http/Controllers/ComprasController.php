<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Depositos;
use App\Models\inventario;
use App\Models\Marcas;
use App\Models\motos;
use App\Models\Nacionalidades;
use App\Models\Proveedores;
use Illuminate\Http\Request;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    $compras = Compra::with('proveedor')->get();
        return view('admin.compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    $proveedores = Proveedores::all();
         $marcas = Marcas::all();
         $nacionalidades = Nacionalidades::all();
         $depositos = Depositos::all();
         $motos = motos::all();
        return view('admin.compras.create', compact('proveedores','motos','marcas','nacionalidades','depositos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $datos = request()->all();
        return response()->json($datos);
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compras)
    {
        //
    }
}
