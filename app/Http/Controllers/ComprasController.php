<?php

namespace App\Http\Controllers;
use App\Models\Compra;
use App\Models\Deposito;
use App\Models\Marca;
use App\Models\Moto;
use App\Models\Nacionalidad;
use App\Models\Proveedor;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motos = Moto::with('marca','compra','nacionalidad','deposito')->orderBy("id", "desc")->get();
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
        /*  return response()->json([
                'received_data' => $request->all(),
                'files' => $request->file() ?: 'No files'
            ]);  */
         /*  $datos = request()->all();
         return response()->json($datos); */
      /*     dd($request->file('imagen_moto'));  */

           $request->validate([
                'id_proveedor' => 'required|exists:proveedores,id',
                'fecha_compra' => 'required',
                'numero_factura' => 'required|unique:compras,numero_factura',
                'numero_remito' => 'required',
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
                'imagen_moto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
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
        $compra = Compra::with(['moto.marca','moto.nacionalidad','moto.deposito', 'proveedor'])->findOrFail($id);

        $motos = $compra->moto->map(function($moto) {
            return [
                 'marca_nombre' => $moto->marca->nombre_marca ?? 'Sin marca',
                'modelo' => $moto->modelo_moto,
                'dominio' => $moto->dominio,
                'cilindrada_moto' => $moto->cilindrada_moto,
                'color' => $moto->color_moto,
                'nacionalidad' => $moto->nacionalidad->pais ?? 'N/A',
                'anio_moto' => $moto->anio_moto,
                'km_moto' => $moto->km_moto,
                'es_usada' => $moto->es_usada,
                'nr_motor' => $moto->nr_motor,
                'nr_chasis' => $moto->nr_chasis,
                'dnrpa' => $moto->dnrpa,
                'nr_certificado' => $moto->nr_certificado,
                'precio_compra' => $moto->precio_compra,
                'precio_venta' => $moto->precio_venta,
                'deposito' => $moto->deposito->nombre_deposito ?? 'N/A',
                'condicion' => $moto->condicion,
                'imagen_moto' => $moto->imagen_moto
                ];
        });

        return response()->json([
            'fecha_formateada' => \App\Helpers\Helpers::cambiaFormatoFecha(($compra->fecha_compra)),
            'total_formateado' => number_format($compra->total_compra, 2),
              'proveedor' => [ // Datos adicionales del proveedor
                    'nombre_proveedor' => $compra->proveedor->nombre_proveedor ?? 'N/A',
                    'celular' => $compra->proveedor->celular ?? 'N/A',
                    'telefono' => $compra->proveedor->telefono ?? 'N/A',
                    'cuit' => $compra->proveedor->cuit ?? 'N/A',
                    'email' => $compra->proveedor->email ?? 'N/A',
                ],
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
        $motos = Moto::with('marca','nacionalidad','deposito')->where('id_compra',$id)->firstOrFail();
        $compra = Compra::with('proveedor','moto')->findOrFail($id);

        $motoVendida = $compra->moto->contains(function ($moto) {
            return $moto->condicion == 'vendida';
        });

        if ($motoVendida) {
            abort(403, 'No se puede editar una compra con motos ya vendidas.');
        }
        return view('admin.compras.edit', compact('proveedores','motos','marcas','nacionalidades','depositos','compra'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
           /*    return response()->json([
                'received_data' => $request->all(),
                'files' => $request->file() ?: 'No files'
            ]); */
          /*   dd($request->all());  */
        $moto = Moto::where('id_compra', $id)->first();
        $request->validate([
        'id_proveedor' => 'required|exists:proveedores,id',
        'fecha_compra' => 'required|date',
        'numero_factura' => 'required|unique:compras,numero_factura,'.$id,
        'numero_remito' => 'required',
        'total_compra' => 'required|numeric',
        'id_marca' => 'required|exists:marcas,id',
        'modelo_moto' => 'required|string|max:255',
        'dominio' => 'required|unique:motos,dominio,'.$moto->id, 
        'cilindrada_moto' => 'required|string|max:255',
        'km_moto' => 'required|string|max:255',
        'es_usada' => 'required|string|max:255',
        'dnrpa' => 'required|string|max:255',
        'nr_certificado' => 'nullable|string|max:255',
        'precio_venta' => 'required|numeric|min:0',
        'id_deposito' => 'required|exists:depositos,id',
        'color_moto' => 'required|string|max:255',
        'anio_moto' => 'required|string|max:255',
        'id_nacionalidad' => 'required|exists:nacionalidades,id',
        'nr_motor' => 'required|string|max:255',
        'nr_chasis' => 'required|string|max:255',
        'precio_compra' => 'required|numeric|min:0',
        'imagen_moto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $compra = Compra::findOrFail($id);

    $compra->id_proveedor = $request->id_proveedor;
    $compra->fecha_compra = $request->fecha_compra;
    $compra->numero_factura = $request->numero_factura;
    $compra->numero_remito = $request->numero_remito;
    $compra->total_compra = $request->total_compra;
    $compra->estado_compra = 1;
    $compra->save();

    $moto = Moto::where('id_compra', $id)->first();

    $moto->id_nacionalidad = $request->id_nacionalidad;
    $moto->id_marca = $request->id_marca;
    $moto->modelo_moto = $request->modelo_moto;
    $moto->dominio = $request->dominio;
    $moto->cilindrada_moto = $request->cilindrada_moto;
    $moto->km_moto = $request->km_moto;
    $moto->es_usada = $request->es_usada;
    $moto->dnrpa = $request->dnrpa;
    $moto->nr_certificado = $request->nr_certificado;
    $moto->precio_venta = $request->precio_venta;
    $moto->id_deposito = $request->id_deposito;
    $moto->color_moto = $request->color_moto;
    $moto->anio_moto = $request->anio_moto;
    $moto->nr_motor = $request->nr_motor;
    $moto->nr_chasis = $request->nr_chasis;
    $moto->precio_compra = $request->precio_compra;
    $moto->estado_moto = "En_stock";
    $moto->condicion = "en_stock";
    $moto->fecha_venta_moto = null;
    $moto->fecha_compra_moto = $request->fecha_compra;
    if ($request->hasFile('imagen_moto')) {
    // Borrar la imagen anterior si existe
    if ($moto->imagen_moto) {
        $rutaImagenAnterior = str_replace('storage/', '', $moto->imagen_moto);
        Storage::disk('public')->delete($rutaImagenAnterior);
    }
    // Obtener el archivo
    $file = $request->file('imagen_moto');
    if ($file->isValid()) {
        // Generar nombre único como en crear
        $nombreArchivo = 'moto_' . time() . '_0.' . $file->extension(); // 0 porque solo es una imagen

        // Guardar en storage/public/motos con nombre personalizado
        $path = $file->storeAs('motos', $nombreArchivo, 'public');

        // Guardar ruta accesible
        $moto->imagen_moto = 'storage/' . $path;
    }
  }
    $moto->save();

    return redirect()->route('admin.compras.index')
        ->with('mensaje','Se Modifico la compra exitosamente')
        ->with('icono','success');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      try {
        $compra = Compra::findOrFail($id);
        $moto = Moto::where('id_compra', $id)->first();

        // Verificar si existe venta asociada
        if ($moto) {
            $existeVenta = Venta::where('id_moto', $moto->id)->exists();

            if ($existeVenta) {
                return redirect()->route('admin.compras.index')
                    ->with('swal', [
                        'title' => 'Error',
                        'text' => 'No se puede eliminar la compra porque la moto tiene una venta asociada',
                        'icon' => 'error'
                    ]);
            }

            // Eliminar la moto primero si existe
            $moto->delete();
        }

        // Eliminar la compra
        $compra->delete();

        return redirect()->route('admin.compras.index')
            ->with('swal', [
                'title' => 'Éxito',
                'text' => 'Compra eliminada correctamente',
                'icon' => 'success'
            ]);

    } catch (\Exception $e) {
        return redirect()->route('admin.compras.index')
            ->with('swal', [
                'title' => 'Error',
                'text' => 'Ocurrió un error al eliminar: ' . $e->getMessage(),
                'icon' => 'error'
            ]);
    }
}

}
