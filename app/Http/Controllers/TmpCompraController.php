<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Deposito;
use App\Models\Marca;
use App\Models\Moto;
use App\Models\Nacionalidad;
use App\Models\TmpMoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class TmpCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function getMotos()
    {
        $sessionId = session()->getId();
        $motos = TmpMoto::with('marca')->where('session_id', session()->getId())->get();

        return response()->json(['success' => true, 'motos' => $motos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       /*  $datos = request()->all();
        return response()->json($datos); */
        try {
            // Validar los datos que vienen del modal
            $validator = Validator::make($request->all(), [
                'id_marca' => 'required',
                'modelo_moto' => 'required',
                'dominio' => ['nullable', function ($attribute, $value, $fail) {
                    if (Moto::where('dominio', $value)->exists() || TmpMoto::where('dominio', $value)->exists()) {
                        $fail('El dominio ya existe en la base de datos.');
                    }
                }],
                'id_nacionalidad' => 'required',
                'cilindrada_moto' => 'required|numeric|min:0',
                'color_moto' => 'required',
                'anio_moto' => 'required|numeric|min:0',
                'km_moto' => 'required|numeric|min:0',
                'es_usada' => 'required',
                'nr_motor' => ['required', function ($attribute, $value, $fail) {
                    if (Moto::where('nr_motor', $value)->exists() || TmpMoto::where('nr_motor', $value)->exists()) {
                        $fail('El número de motor ya existe en la base de datos.');
                    }
                }],
                'nr_chasis' => ['required', function ($attribute, $value, $fail) {
                    if (Moto::where('nr_chasis', $value)->exists() || TmpMoto::where('nr_chasis', $value)->exists()) {
                        $fail('El número de chasis ya existe en la base de datos.');
                    }
                }],
                'dnrpa' => ['nullable', function ($attribute, $value, $fail) {
                    if ($value && (Moto::where('dnrpa', $value)->exists() || TmpMoto::where('dnrpa', $value)->exists())) {
                        $fail('El DNRPA ya existe en la base de datos.');
                    }
                }],
                'nr_certificado' => 'nullable|unique:tmp_motos,nr_certificado',
                'precio_compra' => 'required',
                'precio_venta' => 'nullable',
                'imagen_moto' => 'nullable',
                'id_deposito' => 'required',
            ]);

            // Si la validación falla, devolver errores en JSON
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Crear la moto temporal
            $tmpMoto = new TmpMoto();
            $tmpMoto->id_marca = $request->id_marca;
            $tmpMoto->modelo_moto = $request->modelo_moto;
            $tmpMoto->dominio = $request->dominio;
            $tmpMoto->id_nacionalidad = $request->id_nacionalidad;
            $tmpMoto->cilindrada_moto = $request->cilindrada_moto;
            $tmpMoto->color_moto = $request->color_moto;
            $tmpMoto->anio_moto = $request->anio_moto;
            $tmpMoto->km_moto = $request->km_moto;
            $tmpMoto->es_usada = $request->es_usada;
            $tmpMoto->nr_motor = $request->nr_motor;
            $tmpMoto->nr_chasis = $request->nr_chasis;
            $tmpMoto->dnrpa = $request->dnrpa;
            $tmpMoto->nr_certificado = $request->nr_certificado;
            $tmpMoto->precio_compra = $request->precio_compra;
            $tmpMoto->precio_venta = $request->precio_venta;
            $tmpMoto->id_deposito = $request->id_deposito;
            $tmpMoto->session_id = session()->getId();

            /* if (!Storage::disk('public')->exists('motos')) {
                Storage::disk('public')->makeDirectory('motos');
            } */

            // Guardar la imagen si viene
            if ($request->hasFile('imagen_moto')) {
                $file = $request->file('imagen_moto');
                $nombreArchivo = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('motos', $nombreArchivo, 'public');
                $tmpMoto->imagen_moto = 'storage/motos/' . $nombreArchivo;
            }

            $tmpMoto->save();

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

    public function editarMoto($motoId){
         $nacionalidades = Nacionalidad::all();
        $depositos = Deposito::all();
        $marcas = Marca::all();
        $moto = tmpMoto::findOrFail($motoId);

        if ($moto && $moto->condicion === 'vendida') {
            return redirect()->back()->with('mensaje', 'No se puede editar una moto que ya fue vendida.')
                ->with('icono', 'error');
        }
        return view('admin.compras.edit_tmp_moto', compact(
            'moto',
            'nacionalidades',
            'depositos',
            'marcas'
        ));

    }

    public function update(Request $request, $motoId)
    {
        $request->validate([
        'id_marca' => 'required',
        'id_nacionalidad' => 'required',
        'modelo_moto' => 'required|string|max:255',
        'dominio' => 'nullable|unique:tmp_motos,dominio,' . $motoId,
        'cilindrada_moto' => 'required|numeric',
        'color_moto' => 'nullable|string|max:50',
        'anio_moto' => 'nullable|numeric',
        'km_moto' => 'nullable|numeric',
        'nr_motor' => 'required|unique:tmp_motos,nr_motor,' . $motoId,
        'nr_chasis' => 'required|unique:tmp_motos,nr_chasis,' . $motoId,
        'dnrpa' => 'nullable|unique:tmp_motos,dnrpa,' . $motoId,
        'nr_certificado' => 'nullable|unique:tmp_motos,nr_certificado,' . $motoId,
        'imagen_moto' => 'nullable|image|max:2048',
        'precio_compra' => 'required',
        'precio_venta' => 'nullable',
        'id_deposito' => 'required',
    ]);

    // Buscar la moto temporal
    $moto = TmpMoto::findOrFail($motoId);

    // Actualizar campos
    $moto->id_marca = $request->id_marca;
    $moto->id_nacionalidad = $request->id_nacionalidad;
    $moto->id_deposito = $request->id_deposito;
    $moto->modelo_moto = $request->modelo_moto;
    $moto->dominio = $request->dominio;
    $moto->cilindrada_moto = $request->cilindrada_moto;
    $moto->color_moto = $request->color_moto;
    $moto->anio_moto = $request->anio_moto;
    $moto->km_moto = $request->km_moto;
    $moto->es_usada = $request->has('es_usada') ? 1 : 0;
    $moto->nr_motor = $request->nr_motor;
    $moto->nr_chasis = $request->nr_chasis;
    $moto->dnrpa = $request->dnrpa;
    $moto->nr_certificado = $request->nr_certificado;

    // Formatear precios
    $moto->precio_compra = floatval(str_replace(['.', ','], ['', '.'], $request->precio_compra));
    $moto->precio_venta = floatval(str_replace(['.', ','], ['', '.'], $request->precio_venta ?? 0));

    // Subir nueva imagen si existe
    if ($request->hasFile('imagen_moto')) {
        // Eliminar imagen antigua si existe
        if ($moto->imagen_moto && \Illuminate\Support\Facades\Storage::exists(str_replace('storage/', 'public/', $moto->imagen_moto))) {
            \Illuminate\Support\Facades\Storage::delete(str_replace('storage/', 'public/', $moto->imagen_moto));
        }
        $file = $request->file('imagen_moto');
        $nombreArchivo = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('motos', $nombreArchivo, 'public');
        $moto->imagen_moto = 'storage/motos/' . $nombreArchivo;
    }

    $moto->session_id = session()->getId();

    $moto->save();

    return redirect()->route('admin.compras.create')
        ->with('mensaje', 'Moto actualizada correctamente')
        ->with('icono', 'success');

    }


    public function listar()
    {
        $sessionId = session()->getId();
        $motos = TmpMoto::with(['nacionalidad', 'deposito', 'marca'])
            ->where('session_id', $sessionId)
            ->get();

        return response()->json([
            'success' => true,
            'motos' => $motos
        ]);
    }


    public function destroy($id)
    {
        $tmp = TmpMoto::findOrFail($id);
        $tmp->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Moto eliminada del carrito');
    }
}
