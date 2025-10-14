<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Moto;
use App\Models\Proveedor;
use App\Models\Marca;
use App\Models\Nacionalidad;
use App\Models\Deposito;
use App\Models\TmpMoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('motos')->orderBy('id', 'desc')->get();

        $granTotal = Compra::sum('total_compra');
        $totalPagadas = Compra::where('estado_compra', 'pagado')->sum('total_compra');
        $totalPendientes = Compra::where('estado_compra', 'pendiente')->sum('total_compra');

        return view('admin.compras.index', compact('compras','granTotal', 'totalPagadas', 'totalPendientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $motos = Moto::all();
        $proveedores = Proveedor::all();
        $marcas = Marca::all();
        $nacionalidades = Nacionalidad::all();
        $depositos = Deposito::where('nombre_deposito', '!=', 'Vendida')->get();
        $session_id = session()->getId();
        $tmp_motos = TmpMoto::with('moto')
            ->where('session_id', session()->getId())
            ->get();

        return view('admin.compras.create', compact(
            'motos',
            'proveedores',
            'tmp_motos',
            'marcas',
            'nacionalidades',
            'depositos',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*  $datos = request()->all();
        return response()->json($datos);  */

        // Validación de la compra
        $request->validate([
            'fecha_compra' => 'required|date',
            'numero_factura' => [
                'nullable',
                'string',
                Rule::unique('compras', 'numero_factura')
                    ->where(fn($query) => $query->where('id_proveedor', $request->id_proveedor))
            ],
            'numero_remito' => [
                'required',
                'string',
                Rule::unique('compras', 'numero_remito')
                    ->where(fn($query) => $query->where('id_proveedor', $request->id_proveedor))
            ],
            'estado_compra' => 'required|string',
            'id_proveedor' => 'required|integer',
            'total_compra' => 'required|numeric',
        ], [], [
            'id_proveedor' => 'Proveedor',
        ]);

        $session_id = session()->getId();
        $tmpMotos = TmpMoto::where('session_id', $session_id)->whereNull('id_compra')->get();

        if ($tmpMotos->isEmpty()) {
            return back()->with('mensaje', 'No hay motos cargadas para esta compra.')
                        ->with('icono', 'error')
                        ->withInput();
        }

        // Validar duplicados entre las tmpMotos
        $valoresTemp = [];
        foreach ($tmpMotos as $tmpMoto) {
            $key = $tmpMoto->nr_motor . '|' . $tmpMoto->dominio . '|' . $tmpMoto->nr_chasis;
            if (in_array($key, $valoresTemp)) {
                return back()->with('mensaje', 'Hay duplicados dentro de las motos cargadas en esta compra.');
            }
            $valoresTemp[] = $key;
        }

        // Transacción para asegurar que todo se guarde correctamente
        DB::beginTransaction();

        try {
            // Crear compra
            $compra = new Compra();
            $compra->fecha_compra = $request->fecha_compra;
            $compra->numero_factura = $request->numero_factura;
            $compra->numero_remito = $request->numero_remito;
            $compra->estado_compra = $request->estado_compra;
            $compra->id_proveedor = $request->id_proveedor;
            $compra->total_compra = $request->total_compra;
            $compra->save();

            // Crear motos
            /* dd($tmpMotos); */
            foreach ($tmpMotos as $tmpMoto) {
                Moto::create([
                    'id_marca' => $tmpMoto->id_marca,
                    'modelo_moto' => $tmpMoto->modelo_moto,
                    'dominio' => $tmpMoto->dominio,
                    'id_nacionalidad' => $tmpMoto->id_nacionalidad,
                    'cilindrada_moto' => $tmpMoto->cilindrada_moto,
                    'color_moto' => $tmpMoto->color_moto,
                    'anio_moto' => $tmpMoto->anio_moto,
                    'km_moto' => $tmpMoto->km_moto,
                    'es_usada' => $tmpMoto->es_usada,
                    'nr_motor' => $tmpMoto->nr_motor,
                    'nr_chasis' => $tmpMoto->nr_chasis,
                    'dnrpa' => $tmpMoto->dnrpa,
                    'nr_certificado' => $tmpMoto->nr_certificado,
                    'precio_compra' => $tmpMoto->precio_compra,
                    'precio_venta' => $tmpMoto->precio_venta,
                    'imagen_moto' => $tmpMoto->imagen_moto,
                    'id_deposito' => $tmpMoto->id_deposito,
                    'fecha_compra_moto' => $compra->fecha_compra,
                    'id_compra' => $compra->id,
                ]);
            }

            // Borrar tmpMotos
            TmpMoto::where('session_id', $session_id)->whereNull('id_compra')->delete();

            DB::commit();

            return redirect()->route('admin.compras.index')
                ->with('mensaje', 'Se registró la compra correctamente')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('mensaje', 'Error al registrar la compra: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compra = Compra::with('motos', 'proveedor', 'marca')->findOrFail($id);
        return view('admin.compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contador = 1;
        $nacionalidades = Nacionalidad::all();
        $depositos = Deposito::where('nombre_deposito', '!=', 'Vendida')->get();
        $marcas = Marca::all();
        $sessionId = session()->getId();
        $compra = Compra::with([
            'motos',
            'proveedor',
            'tmpMotos' => function ($query) use ($sessionId) {
                $query->where('session_id', $sessionId);
            }
        ])->findOrFail($id);
        $totalCompra = $compra->motos->sum('precio_compra');

        $proveedores = Proveedor::all();


        return view('admin.compras.edit', compact(
            'compra',
            'proveedores',
            'contador',
            'marcas',
            'nacionalidades',
            'depositos',
            'totalCompra',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$datos = request()->all();
        //return response()->json($datos);
        // Validación de la compra
        $request->validate([
            'fecha_compra' => 'required|date',
            'numero_factura' => [
                'required',
                'string',
                Rule::unique('compras', 'numero_factura')
                    ->where(fn($query) => $query->where('id_proveedor', $request->id_proveedor))
                    ->ignore($id),
            ],
            'numero_remito' => [
                'required',
                'string',
                Rule::unique('compras', 'numero_remito')
                    ->where(fn($query) => $query->where('id_proveedor', $request->id_proveedor))
                    ->ignore($id),
            ],
            'estado_compra' => 'required|string',
            'id_proveedor' => 'required|integer',
            'total_compra' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $compra = Compra::find($id);
            $compra->fecha_compra = $request->fecha_compra;
            $compra->numero_factura = $request->numero_factura;
            $compra->numero_remito = $request->numero_remito;
            $compra->estado_compra = $request->estado_compra;
            $compra->id_proveedor = $request->id_proveedor;
            $compra->total_compra = $request->total_compra;
            $compra->save();

            // Traer las motos temporales vinculadas a esta compra
            $tmpMotos = TmpMoto::where('id_compra', $compra->id)->get();

            foreach ($tmpMotos as $tmpMoto) {
                Moto::create([
                    'id_marca'         => $tmpMoto->id_marca,
                    'modelo_moto'      => $tmpMoto->modelo_moto,
                    'dominio'          => $tmpMoto->dominio,
                    'id_nacionalidad'  => $tmpMoto->id_nacionalidad,
                    'cilindrada_moto'  => $tmpMoto->cilindrada_moto,
                    'color_moto'       => $tmpMoto->color_moto,
                    'anio_moto'        => $tmpMoto->anio_moto,
                    'km_moto'          => $tmpMoto->km_moto,
                    'es_usada'         => $tmpMoto->es_usada,
                    'nr_motor'         => $tmpMoto->nr_motor,
                    'nr_chasis'        => $tmpMoto->nr_chasis,
                    'dnrpa'            => $tmpMoto->dnrpa,
                    'nr_certificado'   => $tmpMoto->nr_certificado,
                    'precio_compra'    => $tmpMoto->precio_compra,
                    'precio_venta'     => $tmpMoto->precio_venta,
                    'imagen_moto'      => $tmpMoto->imagen_moto,
                    'id_deposito'      => $tmpMoto->id_deposito,
                    'fecha_compra_moto' => $compra->fecha_compra,
                    'id_compra'        => $compra->id,
                    'condicion'        => 'en_stock', // Por defecto
                    'estado_moto'      => 'disponible', // Si tenés este campo
                ]);
            }

            // Borrar las temporales de esa compra
            TmpMoto::where('id_compra', $compra->id)->delete();

            DB::commit();

            return redirect()->route('admin.compras.index')
                ->with('success', 'Compra actualizada y motos agregadas correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar la compra: ' . $e->getMessage());
        }
    }

    public function agregarMotoCompra(Request $request)
    {

        try {
            // Validar los datos que vienen del modal
            $validator = Validator::make($request->all(), [
                'id_marca' => 'required',
                'modelo_moto' => 'required',
                'dominio' => 'nullable|unique:motos,dominio',
                'id_nacionalidad' => 'required',
                'cilindrada_moto' => 'required|numeric|min:0',
                'color_moto' => 'required',
                'anio_moto' => 'required|numeric|min:0',
                'km_moto' => 'required|numeric|min:0',
                'es_usada' => 'required',
                'nr_motor' => 'required|unique:motos,nr_motor',
                'nr_chasis' => 'required|unique:motos,nr_chasis',
                'dnrpa' => 'nullable|unique:motos,dnrpa',
                'nr_certificado' => 'nullable|unique:motos,nr_certificado',
                'precio_compra' => 'required',
                'precio_venta' => 'nullable',
                'imagen_moto' => 'nullable|image|mimes:jpg,jpeg,png,gif',
                'id_deposito' => 'required',
            ], [], [
                'id_marca' => 'Marca',
                'modelo_moto' => 'Modelo',
                'dominio' => 'Dominio',
                'id_nacionalidad' => 'Nacionalidad',
                'cilindrada_moto' => 'Cilindrada',
                'color_moto' => 'Color',
                'anio_moto' => 'Año',
                'km_moto' => 'Kilometraje',
                'es_usada' => 'Condición de uso',
                'nr_motor' => 'Número de motor',
                'nr_chasis' => 'Número de chasis',
                'dnrpa' => 'DNRPA',
                'nr_certificado' => 'Número de certificado',
                'precio_compra' => 'Precio de compra',
                'precio_venta' => 'Precio de venta',
                'imagen_moto' => 'Imagen de la moto',
                'id_deposito' => 'Depósito',
            ]);

            // Si la validación falla, devolver errores en JSON
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $compraId = $request->input('compra_id');
            $moto = new Moto();
            $moto->id_compra = $compraId; // el nombre del campo que relaciona con compra
            $moto->id_marca = $request->id_marca;
            $moto->modelo_moto = $request->modelo_moto;
            $moto->dominio = $request->dominio;
            $moto->id_nacionalidad = $request->id_nacionalidad;
            $moto->cilindrada_moto = $request->cilindrada_moto;
            $moto->color_moto = $request->color_moto;
            $moto->anio_moto = $request->anio_moto;
            $moto->km_moto = $request->km_moto;
            $moto->es_usada = $request->es_usada;
            $moto->nr_motor = $request->nr_motor;
            $moto->nr_chasis = $request->nr_chasis;
            $moto->dnrpa = $request->dnrpa;
            $moto->nr_certificado = $request->nr_certificado;
            $moto->precio_compra = $request->precio_compra;
            $moto->precio_venta = $request->precio_venta;
            $moto->id_deposito = $request->id_deposito;
            $moto->fecha_compra_moto = $request->fecha_compra;


            if ($request->hasFile('imagen_moto')) {
                $file = $request->file('imagen_moto');
                $nombreArchivo = time() . '_' . $file->getClientOriginalName();

                // Guarda el archivo en storage/app/public/motos
                $file->storeAs('motos', $nombreArchivo, 'public');

                // Guarda la ruta relativa para usar en la vista
                $moto->imagen_moto = 'storage/motos/' . $nombreArchivo;
            }


            $moto->save();

            return response()->json([
                'success' => true,
                'message' => 'Moto agregada correctamente a la tabla.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error interno: ' . $e->getMessage()
            ], 500);
        }
    }

    public function editarMotoCompra($compraId, $motoId)
    {
        $nacionalidades = Nacionalidad::all();
        $depositos = Deposito::where('nombre_deposito', '!=', 'Vendida')->get();
        $marcas = Marca::all();
        $compra = Compra::findOrFail($compraId);
        $moto = $compra->motos()->where('id', $motoId)->firstOrFail();

        if ($moto && $moto->condicion === 'vendida') {
            return redirect()->back()->with('mensaje', 'No se puede editar una moto que ya fue vendida.')
                ->with('icono', 'error');
        }
        return view('admin.compras.editar_moto', compact(
            'compra',
            'moto',
            'nacionalidades',
            'depositos',
            'marcas'
        ));
    }
    public function actualizarMotoCompra(Request $request, $compraId, $motoId)
    {

        // Validar datos
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required|string|max:255',
            'dominio' => 'nullable|unique:motos,dominio,' . $motoId,
            'cilindrada' => 'required|numeric',
            'color' => 'nullable|string|max:50',
            'anio' => 'nullable|numeric',
            'km' => 'nullable|numeric',
            'motor' => 'required|unique:motos,nr_motor,' . $motoId,
            'chasis' => 'required|unique:motos,nr_chasis,' . $motoId,
            'dnrpa' => 'nullable|unique:motos,dnrpa,' . $motoId,
            'certificado' => 'nullable|unique:motos,nr_certificado,' . $motoId,
            'imagen_moto' => 'nullable',
            'nacionalidad' => 'required',
            'precio_compra' => 'required',
        ]);

        // Buscar la compra y la moto
        $compra = Compra::findOrFail($compraId);
        $moto = $compra->motos()->where('id', $motoId)->firstOrFail();
        //dd($moto);
        // Asignar valores
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

        // Formatear precio compra
        $precio_compra = str_replace(['.', ','], ['', '.'], $request->precio_compra);
        $moto->precio_compra = $precio_compra;


        // Formatear precio venta
        $precio_venta = str_replace(['.', ','], ['', '.'], $request->precio_venta);
        $moto->precio_venta = $precio_venta;

        if ($request->hasFile('imagen_moto')) {
            // Eliminar la imagen antigua si existe
            if ($moto->imagen_moto && Storage::exists(str_replace('storage/', 'public/', $moto->imagen_moto))) {
                Storage::delete(str_replace('storage/', 'public/', $moto->imagen_moto));
            }

            // Subir nueva imagen
            $file = $request->file('imagen_moto');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('motos', $nombreArchivo, 'public');

            // Guardar en DB con "storage/motos/..."
            $moto->imagen_moto = 'storage/motos/' . $nombreArchivo;
        }

        // Guardar cambios
        $moto->save();
        // Recalcular el total de la compra con la suma de todas las motos
        $total = $compra->motos()->sum('precio_compra');

        // Actualizar la compra
        $compra->total_compra = $total;
        $compra->save();
        return redirect()->route('admin.compras.edit', $compraId)
            ->with('mensaje', 'Moto actualizada correctamente.')
            ->with('icono', 'success');
        //->with('success', 'Moto actualizada correctamente.');
    }


    public function eliminarMotoCompra($id)
    {
        $moto = Moto::with('compra')->findOrFail($id);

        // Si la moto ya está vendida -> no permitir
        if ($moto->condicion === 'vendida') {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar una moto vendida.'
            ], 400);
        }

        $compra = $moto->compra;

        // Elimino la moto
        $moto->delete();

        // Si no quedan más motos en la compra -> elimino la compra también
        if ($compra->motos()->count() === 0) {
            $compra->delete();
            return response()->json([
                'success' => true,
                'compraEliminada' => true,
                'message' => 'La moto y la compra fueron eliminadas correctamente.'
            ]);
        }

        return response()->json([
            'success' => true,
            'compraEliminada' => false,
            'message' => 'Moto eliminada correctamente.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $compra = Compra::with('motos')->findOrFail($id);

        // Verificar si hay alguna moto vendida en la compra
        $tieneVendidas = $compra->motos()->where('condicion', 'vendida')->exists();

        if ($tieneVendidas) {
            return redirect()->route('admin.compras.index')
                ->with('mensaje', 'Error al eliminar.')
                ->with('descripcion', 'Existen motos vendidas en la compra.')
                ->with('icono', 'error');
        }

        // Si no hay motos vendidas → eliminamos todas las motos y la compra
        foreach ($compra->motos as $moto) {
            $moto->delete();
        }

        $compra->delete();

        return redirect()->route('admin.compras.index')
            ->with('success', 'La compra y sus motos fueron eliminadas correctamente.');
    }
}
