<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use App\Models\TmpMoto;
use Illuminate\Http\Request;
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
        try {
        // Validar los datos que vienen del modal
        $validator = Validator::make($request->all(), [
            'marca_moto' => 'required',
            'modelo_moto' => 'required',
            'dominio' => 'nullable|unique:tmp_motos,dominio',
            'id_nacionalidad' => 'required',
            'cilindrada_moto' => 'required|numeric|min:0',
            'color_moto' => 'required',
            'anio_moto' => 'required|numeric|min:0',
            'km_moto' => 'required|numeric|min:0',
            'es_usada' => 'required',
            'nr_motor' => 'required|unique:tmp_motos,nr_motor',
            'nr_chasis' => 'required|unique:tmp_motos,nr_chasis',
            'dnrpa' => 'nullable|unique:tmp_motos,dnrpa',
            'nr_certificado' => 'nullable|unique:tmp_motos,nr_certificado',
            'precio_compra' => 'required',
            'precio_venta' => 'nullable',
            'imagen_moto' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'id_deposito' => 'required',
        ]);

        // Si la validación falla, devolver errores en JSON
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
            $validated['session_id'] = session()->getId();


            $tmpMoto = new TmpMoto();
            $tmpMoto->marca_moto = $request->marca_moto;
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

            if ($request->hasFile('imagen_moto')) {
                $file = $request->file('imagen_moto');
                $nombreArchivo = time() . '_' . $file->getClientOriginalName();

                // Guarda el archivo en storage/app/public/motos
                $file->storeAs('motos', $nombreArchivo, 'public');

                // Guarda la ruta relativa para usar en la vista
                $tmpMoto->imagen_moto = 'storage/motos/' . $nombreArchivo;
            }


            $tmpMoto->save();

            return response()->json([
                'success' => true,
                'message' => 'Moto agregada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error interno: ' . $e->getMessage()
            ], 500);
        }
    }
    public function listar()
    {
        $sessionId = session()->getId();
        $motos = TmpMoto::with(['nacionalidad', 'deposito'])
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

        return redirect()->back()->with('success', 'Moto eliminada');
    }

}