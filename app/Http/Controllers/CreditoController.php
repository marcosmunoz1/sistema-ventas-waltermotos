<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\DetalleCredito;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditoController extends Controller
{
    //
    public function index()
    {
        $creditos = Credito::with('detalles', 'venta')->orderBy('id', 'desc')->get();
        return view('admin.creditos.index', compact('creditos'));
    }

    public function show($id)
    {
        $credito = Credito::with('detalles', 'venta')->where('id', $id)->first();
        return view('admin.creditos.show', compact('credito'));
    }

    public function create($id)
    {
        $credito = Credito::with('detalles', 'venta')->where('id', $id)->first();
        return view('admin.creditos.cobrar-cuotas', compact('credito'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_credito' => 'required|exists:creditos,id',
            'cuotas' => 'required|array|min:1',
            'cuotas.*.id' => 'required|integer|exists:detalles_creditos,id',
            'cuotas.*.numero_cuota' => 'required|integer',
            'cuotas.*.valor_cuota' => 'required|numeric|min:0',
            'fecha' => 'required|date',
            'precioTotal' => 'required|numeric|min:0',
            'interes' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        $fecha_pago = $request->fecha;
        $cuotasPagadas = $request->cuotas;
        $total_pagado = $request->total;
        $interesPorcentaje = $request->interes ?? 0;

        DB::transaction(function () use ($request, $fecha_pago, $cuotasPagadas, $total_pagado, $interesPorcentaje) {

            $interesTotal = 0;

            foreach ($cuotasPagadas as $cuota) {
                $valorCuota = $cuota['valor_cuota'];

                // Calcular interés monetario
                $cuotaSinInteres = $valorCuota / (1 + ($interesPorcentaje / 100));
                $interesMonetario = $valorCuota - $cuotaSinInteres;

                $interesTotal += $interesMonetario;

                DetalleCredito::where('id', $cuota['id'])->update([
                    'fecha_pago' => $fecha_pago,
                    'estado_cuota' => 'Paga',
                    'interes_mora' => $interesMonetario,
                ]);
            }

            // Actualizar crédito
            $credito = Credito::find($request->id_credito);
            $credito->saldo_credito = max(0, $credito->saldo_credito - $total_pagado);
            $credito->total_interes += $interesTotal;
            $credito->save();

            // Actualizar venta
            $venta = Venta::find($credito->id_venta);
            $venta->total_pago += $total_pagado;
            $venta->total_interes += $interesTotal;

            if ($venta->total_pago >= $venta->precio_venta) {
                $venta->estado_venta = 'Pagado';
            }

            $venta->save();
        });

        return redirect()->back()
            ->with('mensaje', 'Cuotas cobradas correctamente.')
            ->with('icono', 'success');
    }

    
}
