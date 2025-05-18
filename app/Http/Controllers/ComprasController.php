<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\inventario;
use App\Models\Deposito;
use App\Models\Marca;
use App\Models\Moto;
use App\Models\Nacionalidad;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    $motos = Moto::with('marca','compra','nacionalidad','deposito')->orderBy("id", "desc")->get();
        return view('admin.compras.index', compact('motos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    $proveedores = Proveedor::all();
         $marcas = Marca::all();
         $nacionalidades = Nacionalidad::all();
         $depositos = Deposito::all();
         $motos = Moto::all();
        return view('admin.compras.create', compact('proveedores','motos','marcas','nacionalidades','depositos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*   $datos = request()->all();
         return response()->json($datos); */

      /*     dd($request->file('imagen_moto'));  */


           $request->validate([
                'id_proveedor' => 'required|exists:proveedores,id',
                'fecha_compra' => 'required',
                'numero_factura' => 'required|unique:compras,numero_factura', // Cambiado de 'number' a 'numeric'
                'numero_remito' => 'required', // Permite que sea opcional
                'total_compra' => 'required',
                'id_marca' => 'required|array',
                'id_marca.*' => 'required|string|max:255',
                'modelo_moto' => 'required|array',
                'modelo_moto.*' => 'required|string|max:255',
                'dominio' => 'required|array',
                'dominio.*' => 'required|string|max:255',
                'cilindrada_moto' => 'required|array',
                'cilindrada_moto.*' => 'required|string|max:255',
                'km_moto' => 'required|array',
                'km_moto.*' => 'required|string|max:255',
                'es_usada' => 'required|array',
                'es_usada.*' => 'required|string|max:255',
                'dnrpa' => 'required|array',
                'dnrpa.*' => 'required|string|max:255',
                'nr_certificado' => 'required|array',
                'nr_certificado.*' => 'required|string|max:255',
                'precio_venta' => 'required|array',
                'precio_venta.*' => 'numeric|min:0',
                'id_deposito' => 'required|array',
                'id_deposito.*' => 'required|string|max:255',
                'color_moto' => 'required|array',
                'color_moto.*' => 'required|string|max:255',
                'anio_moto' => 'required|array',
                'anio_moto.*' => 'required|string|max:255',
                'id_nacionalidad' => 'required|array',
                'id_nacionalidad.*' => 'required|string|max:255',
                'nr_motor' => 'required|array',
                'nr_motor.*' => 'required|string|max:255',
                'nr_chasis' => 'required|array',
                'nr_chasis.*' => 'required|string|max:255',
                'precio_compra' => 'required|array',
                'precio_compra.*' => 'numeric|min:0',
                'imagen_moto' => 'nullable|array',
                'imagen_moto.*' => 'image|mimes:jpeg,png,jpg',
            ]);

             // Procesar imágenes
            $imagenesPaths = [];
            if ($request->hasFile('imagen_moto')) {
                foreach ($request->file('imagen_moto') as $index => $file) {
                    if ($file->isValid()) {
                        // Generar nombre único
                        $nombreArchivo = 'moto_'.time().'_'.$index.'.'.$file->extension();

                        // Guardar en storage
                        $path = $file->storeAs('motos', $nombreArchivo, 'public');

                        // Guardar ruta accesible
                        $imagenesPaths[$index] = 'storage/' . $path ;

                        /* Log::info("Imagen guardada: ".$path); // Para depuración */
                    }
                }
            }

            // Preparar datos para el modelo
            $datosCompletos = array_merge($request->except('imagen_moto'), [
                'imagen_moto' => $imagenesPaths
            ]);

            Compra::registrarCompra($datosCompletos);
            return redirect()->route('admin.compras.index')
            ->with('mensaje','Se agrego la compra exitosamente')
            ->with('icono','success');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)

    {
        $compra = Compra::with(['moto.marca', 'proveedor'])->findOrFail($id);

        $motos = $compra->moto->map(function($moto) {
            return [
                'marca_nombre' => $moto->marca->nombre_marca ?? 'Sin marca',
                'modelo' => $moto->modelo_moto,
                'color' => $moto->color_moto,
                'precio' => number_format($moto->precio_compra, 2) // Asumo que precio_compra está en Moto
            ];
        });

        return response()->json([
            'fecha_formateada' => $compra->fecha_compra, 
            'total_formateado' => number_format($compra->total_compra, 2),
            'proveedor_nombre' => $compra->proveedor->nombre_proveedor ?? 'N/A', // Añadido
            'motos' => $motos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $proveedores = Proveedor::all();
        $marcas = Marca::all();
        $nacionalidades = Nacionalidad::all();
        $depositos = Deposito::all();
        $motos = Moto::with('marca','nacionalidad','deposito')->where('id_compra',$id)->get();
        $compra = Compra::with('proveedor')->findOrFail($id);
        return view('admin.compras.edit', compact('proveedores','motos','marcas','nacionalidades','depositos','compra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Compra::destroy($id);
        return redirect()->route('admin.compras.index')
        ->with('mensaje','Se elimino la compra exitosamente')
        ->with('icono','success');
    }
}
