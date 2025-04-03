<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Marca;
use App\Models\Moto;
use App\Models\Proveedores;
use Illuminate\Http\Request;

class MotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motos = Moto::with(['marca', 'nacionalidad', 'compra', 'deposito'])->get();
        return view('admin.motos.index', compact('motos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $marcas = Marca::all();
        return view('admin.motos.create', compact('marcas'));
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
        $moto = Moto::with(['marca', 'nacionalidad', 'compra', 'deposito'])->findOrFail($id);
        $proveedor = Proveedores::where('id', $moto->compra->id_proveedor)->first();

        return view('admin.motos.show', compact('moto','proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Moto $moto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Moto $moto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Moto $moto)
    {
        //
    }
}
