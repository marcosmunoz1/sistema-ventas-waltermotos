<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Moto;
use App\Models\Proveedor;
use App\Models\Marca;
use App\Models\Nacionalidad;
use App\Models\Deposito;
use App\Models\TmpMoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('motos')->get();
        return view('admin.compras.index', compact('compras'));
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
        $depositos = Deposito::all();
        $session_id = session()->getId();
        $tmp_motos = TmpMoto::with('moto')
                ->where('session_id', session()->getId())
                ->get();

        return view('admin.compras.create', compact('motos','proveedores','tmp_motos', 'marcas', 'nacionalidades',
                                                    'depositos',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);
        $request->validate([
            'fecha_compra'=>'required',
            'numero_factura'=>'required',
            'numero_remito'=>'required',
            'estado_compra'=>'required',
            'id_proveedor' => 'required',
            'total_compra'=>'required',
        ]);
        $compra = new Compra();
        $compra->fecha_compra = $request->fecha_compra;
        $compra->numero_factura = $request->numero_factura;
        $compra->numero_remito = $request->numero_remito;
        $compra->estado_compra = $request->estado_compra;
        $compra->id_proveedor = $request->id_proveedor;
        $compra->total_compra = $request->total_compra;
        $compra->save();

        $session_id = session()->getId();

        $tmpMotos = TmpMoto::where('session_id', $session_id)->get();
        //dd($tmpMotos);
        foreach ($tmpMotos as $tmpMoto) {
            Moto::create([
                'marca_moto' => $tmpMoto->marca_moto,
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

        TmpMoto::where('session_id', $session_id)->delete();

        DB::commit();
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Se registró la compra correctamente',
            ]);
        }

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Se registró la compra correctamente')
            ->with('icono', 'success');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compra = Compra::with('motos','proveedor')->findOrFail($id);
        return view('admin.compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contador = 1;
        $nacionalidades = Nacionalidad::all();
        $depositos = Deposito::all();
        $marcas = Marca::all();
        $compra = Compra::with('motos','proveedor')->findOrFail($id);
        $totalCompra = $compra->motos->sum('precio_compra');

        $proveedores = Proveedor::all();


        return view('admin.compras.edit', compact('compra',
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
        $request->validate([
            'fecha_compra'=>'required',
            'numero_factura'=>'required',
            'numero_remito'=>'required',
            'estado_compra'=>'required',
            'id_proveedor' => 'required',
            'total_compra'=>'required',
        ]);

        $compra = Compra::find($id);
        $compra->fecha_compra = $request->fecha_compra;
        $compra->numero_factura = $request->numero_factura;
        $compra->numero_remito = $request->numero_remito;
        $compra->estado_compra = $request->estado_compra;
        $compra->id_proveedor = $request->id_proveedor;
        $compra->total_compra = $request->total_compra;
        $compra->save();

        // Actualizar fecha_compra_moto en todas las motos asociadas
        $compra->motos()->update(['fecha_compra_moto' => $request->fecha_compra]);

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Se actualizó la compra correctamente')
            ->with('icono', 'success');
    }

    public function agregarMotoCompra(Request $request)
    {

        try {
        // Validar los datos que vienen del modal
            $validated = $request->validate([
                'marca_moto' => 'required',
                'modelo_moto' => 'required',
                'dominio' => 'required|nullable',
                'id_nacionalidad' => 'required',
                'cilindrada_moto' => 'required|numeric|min:0',
                'color_moto' => 'required',
                'anio_moto' => 'required|numeric|min:0',
                'km_moto' => 'required|numeric|min:0',
                'es_usada' => 'required',
                'nr_motor' => 'required',
                'nr_chasis' => 'required',
                'dnrpa' => 'required|nullable',
                'nr_certificado' => 'required|nullable',
                'precio_compra' => 'required',
                'precio_venta' => 'required',
                'imagen_moto' => 'nullable|image|mimes:jpg,jpeg,png,gif',
                'id_deposito' => 'required',
            ]);

            $compraId = $request->input('compra_id');
            $fecha_compra = $request->input('fecha_compra');
            $moto = new Moto();
            $moto->id_compra = $compraId; // el nombre del campo que relaciona con compra
            $moto->marca_moto = $request->marca_moto;
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
        $depositos = Deposito::all();
        $marcas = Marca::all();
        $compra = Compra::findOrFail($compraId);
        $moto = $compra->motos()->where('id', $motoId)->firstOrFail();

        if ($compra->motos->contains(fn($m) => $m->condicion === 'vendida')) {
            return redirect()->back()->with('error', 'No se puede editar una moto que ya fue vendida.');
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
            'dominio' => 'required|unique:motos,dominio,' . $motoId,
            'cilindrada' => 'required|numeric',
            'color' => 'nullable|string|max:50',
            'anio' => 'nullable|numeric',
            'km' => 'nullable|numeric',
            'motor' => 'required|unique:motos,nr_motor,' . $motoId,
            'chasis' => 'required|unique:motos,nr_chasis,' . $motoId,
            'dnrpa' => 'nullable|unique:motos,dnrpa,' . $motoId,
            'certificado' => 'nullable|unique:motos,nr_certificado,' . $motoId,
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nacionalidad' => 'required'
        ]);

        // Buscar la compra y la moto
        $compra = Compra::findOrFail($compraId);
        $moto = $compra->motos()->where('id', $motoId)->firstOrFail();
        //dd($moto);
        // Asignar valores
        $moto->marca_moto = $request->marca;
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

        // Formatear precio venta
        $precio_venta = str_replace(['.', ','], ['', '.'], $request->precio_venta);
        $moto->precio_venta = $precio_venta;

        // Verificar si hay nueva imagen
        if ($request->hasFile('imagen')) {
            if ($moto->imagen_moto && Storage::exists('public/' . $moto->imagen_moto)) {
                Storage::delete('public/' . $moto->imagen_moto);
            }
            $imagenPath = $request->file('imagen')->store('motos', 'public');
            $moto->imagen_moto = $imagenPath;
        }

        // Guardar cambios
        $moto->save();

        return redirect()->route('admin.compras.edit', $compraId)->with('success', 'Moto actualizada correctamente.');
    }


    public function eliminarMotoCompra($id)
    {
        $moto = Moto::find($id);

        if (!$moto) {
            return response()->json([
                'success' => false,
                'message' => 'Moto no encontrada'
            ], 404);
        }

        // Validar si está vendida
        if ($moto->condicion === 'vendida') {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar una moto que ya fue vendida'
            ], 403);
        }

        try {
            $moto->delete();
            return response()->json([
                'success' => true,
                'message' => 'Moto eliminada'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la moto'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
