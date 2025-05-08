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
    {    $compras = Compra::with('proveedor')->orderBy("id", "desc")->get();
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
        /*   $datos = request()->all();
         return response()->json($datos); */

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
                'imagen_moto.*' => 'nullable|string|max:255',

            ]);

            Compra::registrarCompra($request->all());

            return redirect()->route('admin.compras.index')
                ->with('mensaje', 'Compra registrada con éxito')
                ->with('icono', 'success');

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

    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit( $id)
    {
        $proveedores = Proveedor::all();
        $marcas = Marca::all();
        $nacionalidades = Nacionalidad::all();
        $depositos = Deposito::all();
        $motos = Moto::where('id_compra',$id)->first();
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
    public function destroy(Compra $compras)
    {
        //
    }
}
