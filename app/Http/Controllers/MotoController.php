<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Deposito;
use App\Models\Marca;
use App\Models\Moto;
use App\Models\Nacionalidad;
use App\Models\Proveedor;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $proveedor = Proveedor::where('id', $moto->compra->id_proveedor)->first();
        $venta = Venta::with('cliente')-> where('id_moto', $id)->first();

        return view('admin.motos.show', compact('moto', 'proveedor', 'venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $moto = Moto::find($id);
        $marcas = Marca::all();
        $nacionalidades = Nacionalidad::all();
        $depositos = Deposito::all();
        return view('/admin/motos/edit', compact('moto', 'marcas', 'nacionalidades','depositos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required|string|max:255',
            'dominio' => 'nullable|unique:motos,dominio,' . $id,
            'cilindrada' => 'required|numeric',
            'color' => 'nullable|string|max:50',
            'anio' => 'nullable|numeric',
            'km' => 'nullable|numeric',
            'motor' => 'required|unique:motos,nr_motor,' . $id,
            'chasis' => 'required|unique:motos,nr_chasis,'. $id,
            'dnrpa' => 'nullable|unique:motos,dnrpa,'. $id,
            'certificado' => 'nullable|unique:motos,nr_certificado,'. $id,
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nacionalidad' => 'required'
        ]);


        $moto = Moto::findOrFail($id);

        $moto->id_marca = $request->marca;
        $moto->modelo_moto = $request->modelo;
        $moto->dominio = $request->dominio;
        $moto->cilindrada_moto = $request->cilindrada;
        $moto->color_moto = $request->color;
        $moto->anio_moto = $request->anio;
        $moto->km_moto = $request->km;
        $moto->nr_motor = $request->motor;
        $moto->nr_chasis = $request->chasis;
        $moto->dnrpa = $request->dnrpa;
        $moto->nr_certificado = $request->certificado;
        $moto->id_nacionalidad = $request->nacionalidad;
        $moto->es_usada = $request->has('es_usada') ? 1 : 0;
        $moto->id_deposito = $request->deposito;

        $precio_venta = str_replace(['.', ','], ['', '.'], $request->precio_venta); // Quitar puntos y cambiar la coma por un punto
        $moto->precio_venta = $precio_venta;


        if ($request->hasFile('imagen_moto')) {
       // Eliminar la imagen antigua si existe
            if ($moto->imagen_moto && Storage::exists(str_replace('storage/', 'public/', $moto->imagen_moto))) {
                Storage::delete(str_replace('storage/', 'public/', $moto->imagen_moto));
            }

            // Subir nueva imagen
            $file = $request->file('imagen_moto');
            $nombreArchivo = time().'_'.$file->getClientOriginalName();
            $file->storeAs('motos', $nombreArchivo, 'public');

            // Guardar en DB con "storage/motos/..."
            $moto->imagen_moto = 'storage/motos/'.$nombreArchivo;
        }

        $moto->save();


        return redirect()->route('admin.motos.index')
            ->with('mensaje', 'Se actualizo la moto con exíto.')
            ->with('icono', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
            
            Moto::destroy($id);
            return redirect()->route('admin.motos.index')
                ->with('mensaje', 'Se elimino la Moto con exíto')
                ->with('icono','success');
    }
}
