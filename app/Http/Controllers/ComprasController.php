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
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

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
        logger($request->all());
        $validated = $request->validate([
            'id_proveedor' => 'required|exists:proveedores,id',
            'fecha_compra' => 'required|date',
            'numero_factura' => 'required|numeric', // Cambiado de 'number' a 'numeric'
            'numero_remito' => 'nullable|string|max:255', // Permite que sea opcional
            'marca' => 'required|array',
            'marca.*' => 'required|string|max:255',
            'modelo' => 'required|array',
            'modelo.*' => 'required|string|max:255',
            'dominio' => 'required|array',
            'dominio.*' => 'required|string|max:255',
            'cilindrada' => 'required|array',
            'cilindrada.*' => 'required|string|max:255',
            'km' => 'required|array',
            'km.*' => 'required|string|max:255',
            'es_usada' => 'required|array',
            'es_usada.*' => 'required|string|max:255',
            'dnrpa' => 'required|array',
            'dnrpa.*' => 'required|string|max:255',
            'nr_certificado' => 'required|array',
            'nr_certificado.*' => 'required|string|max:255',
            'precio_venta' => 'required|array',
            'precio_venta.*' => 'numeric|min:0',
            'deposito' => 'required|array',
            'deposito.*' => 'required|string|max:255',
            'color' => 'required|array',
            'color.*' => 'required|string|max:255',
            'anio' => 'required|array',
            'anio.*' => 'required|string|max:255',
            'nacion' => 'required|array',
            'nacion.*' => 'required|string|max:255',
            'nr_motor' => 'required|array',
            'nr_motor.*' => 'required|string|max:255',
            'nr_chasis' => 'required|array',
            'nr_chasis.*' => 'required|string|max:255',
            'precio_compra' => 'required|array',
            'precio_compra.*' => 'numeric|min:0',
            'imagen' => 'nullable|array',
            'imagen.*' => 'nullable|string|max:255',

        ]);

        try {
            DB::transaction(function () use ($validated) {
                // 1. Crear la compra principal
                $compra = Compra::create([
                    'id_proveedor' => $validated['id_proveedor'],
                    'fecha_compra' => $validated['fecha_compra'],
                    'numero_compra' => 12,
                    'numero_remito' => $validated['numero_remito'] ?? null,
                    'numero_factura' => $validated['numero_factura'],
                    'total_compra' => 122,
                    'estado_compra' => 1,

                ]);

                // 2. Crear los detalles de cada moto
                foreach ($validated['marca'] as $index => $marca) {
                    $moto = Moto::create([
                        'modelo' => $validated['modelo'][$index],
                        'dominio' => $validated['dominio'][$index],
                        'id_nacionalidad' => $validated['nacionalidad'][$index] ,
                        'id_compra' => $compra->id,
                        'id_deposito' => $validated['deposito'][$index],
                        'id_marca' => $validated['marca'][$index],
                        'modelo_moto' => $validated['modelo'][$index],
                        'dominio' => $validated['dominio'][$index],
                        'cilindrada_moto' => $validated['cilindrada'][$index],
                        'color_moto' => $validated['color'][$index],
                        'anio_moto' => $validated['anio'][$index],
                        'km_moto' => $validated['km'][$index],
                        'es_usada' => $validated['es_usada'][$index],
                        'nr_certificado' => $validated['nr_certificado'][$index],
                        'dnrpa' => $validated['dnrpa'][$index],
                        'nr_motor' => $validated['nr_motor'][$index],
                        'nr_chasis' => $validated['nr_chasis'][$index],
                        'fecha_compra_moto' => $validated['fecha_compra'],
                        'fecha_venta_moto' => $validated['fecha_venta'] ?? null,
                        'precio_compra' => $validated['precio_compra'][$index],
                        'precio_venta' => $validated['precio_venta'][$index],
                        'estado_moto' => 1,
                        'imagen_moto' => $validated['imagen'][$index] ?? null,
                    ]);
                }
            });

            return response()->json([
                'success' => true,
                'redirect' => route('compras.index')
            ]);

            } catch (\Exception $e) {
                return back()->withInput()
                    ->with('mensaje', 'Error al registrar la compra: ' . $e->getMessage())
                    ->with('icono', 'error');
            }

        // Redirección con mensaje de éxito
        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Compra registrada con éxito')
            ->with('icono', 'success');


    }

    public function agregarMoto(Request $request){
        {

            $request->validate([
                'marca' => 'required|string|max:100',
                'modelo' => 'required|string|max:100',
                'dominio' => 'nullable|string|max:20',
                'cilindrada' => 'nullable|string|max:50',
                'color' => 'nullable|string|max:50',
                'nacion' => 'nullable|string|max:50',
                'anio_moto' => 'nullable|integer',
                'km' => 'nullable|numeric',
                'es_usada' => 'required|boolean',
                'nr' => 'nullable|string|max:100',
                'nr_chasis' => 'nullable|string|max:100',
                'dnrpa' => 'nullable|string|max:100',
                'certificado' => 'nullable|string|max:100',
                'precio_compra' => 'required|numeric',
                'precio_venta' => 'required|numeric',
                'deposito' => 'nullable|string|max:100',
                'imagen' => 'nullable|file|image|max:2048'
            ]);

            // Guardar la imagen si existe
            $rutaImagen = null;
            if ($request->hasFile('imagen')) {
                $rutaImagen = $request->file('imagen')->store('motos', 'public');
            }
            $contador = 1;
            // Armar array de la moto
            $moto = $request->except('imagen');
            $moto['imagen'] = $rutaImagen;
            $moto['motoId'] = $contador; // ID temporal para poder eliminarla si hiciera falta

            // Reemplazar cualquier moto existente en sesión (solo una)
            session(['moto_temporal' => $moto]);

            return response()->json([
                'success' => true,
                'motos' => [$moto] // lo devolvés como array para que funcione tu función de JS
            ]);


            }
    }
    public function eliminarMoto(Request $request)
        {
            // Obtener el ID de la moto a eliminar
            $motoId = $request->input('motoId');

            // Recuperar la moto temporal almacenada en la sesión
            $moto_temporal = session('moto_temporal');

            if ($moto_temporal && isset($moto_temporal['motoId']) && $moto_temporal['motoId'] == $motoId) {
                // Eliminar la moto de la sesión
                session()->forget('moto_temporal');

                // Retornar una respuesta indicando éxito y enviando un array vacío
                return response()->json([
                    'success' => true,
                    'motos'   => []  // Ya que no hay motos temporales
                ]);
            }

            // Si no se encuentra la moto en la sesión
            return response()->json([
                'success' => false,
                'message' => 'Moto no encontrada en la sesión'
            ]);
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

    public function edit( $id)
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
