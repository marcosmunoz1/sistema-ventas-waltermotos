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
use Illuminate\Support\Facades\Session;

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
          $datos = request()->all();
        return response()->json($datos);
       /*  Compras::registrarCompra($request->all());

        // Redirección con mensaje de éxito
        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Compra registrada con éxito')
            ->with('icono', 'success'); */
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
