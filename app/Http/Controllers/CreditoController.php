<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\DetalleCredito;
use App\Models\Moto;
use App\Models\Venta;
use Carbon\Carbon;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Luecano\NumeroALetras\NumeroALetras;

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
            $credito->saldo_credito =  $credito->saldo_credito - $valorCuota;
            $credito->total_interes += $interesTotal;
            //  dd($credito->saldo_credito);
            if ($credito->saldo_credito <= 0) {
                $credito->estado_credito = 'Pagado';
            }
            $credito->save();

            // Actualizar venta
            $venta = Venta::find($credito->id_venta);
            $venta->total_pago += $total_pagado;
            $venta->total_interes += $interesTotal;
            if ($venta->total_pago >= $venta->precio_venta) {
                $venta->estado_venta = 'Paga';
            }
            $venta->save();

            session([
                'mostrar_boton_recibo' => true,
                'recibo_pago_datos' => [
                    'cuotas' => $cuotasPagadas,
                    'fecha_pago' => $fecha_pago,
                    'total_pagado' => $total_pagado,
                    'id_credito' => $request->id_credito
                ]
            ]);
        });



        return redirect()->back()
            ->with('mensaje', 'Cuotas cobradas correctamente.')
            ->with('icono', 'success');
    }


    public function reporte($id)
    {
        $detalle = DetalleCredito::find($id);
        $credito = Credito::with('venta')->where('id', $detalle->id_credito)->first();

        $formatter = new NumeroALetras(); 
        $montoLetras = $formatter->toMoney($detalle->valor_cuota, 2, 'pesos', 'centavos');

         $formatter2 = new NumeroALetras(); 
        $cuotaLetras = $formatter2->toMoney($detalle->numero_cuota);

        // Renderizar la vista Blade en HTML
        $html = view('admin.creditos.reporte', compact('detalle', 'credito', 'montoLetras', 'cuotaLetras'))->render();

        // Crear la instancia de DomPDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();

        // Crear el nombre del archivo
        $fecha = \Carbon\Carbon::parse($detalle->fecha_pago)->format('d-m-Y');
        $idCredito = $credito->id;
        $numeroRecibo = $detalle->id ?? 'recibo';
        $nombreArchivo = "Recibo_{$numeroRecibo}_{$fecha}_{$idCredito}_cuota_{$detalle->numero_cuota}.pdf";

        // Retornar el PDF como descarga con el nombre generado
        return $dompdf->stream($nombreArchivo);
    }

    public function destroy($id)
    {
        $credito = Credito::findOrFail($id);

        DB::transaction(function () use ($credito) {

            $venta = Venta::where('id_venta', $credito->id_venta)->first();

            if ($credito) {
                // Elimina los detalles correctamente
                DetalleCredito::where('id_credito', $credito->id)->delete();
                $credito->delete();
            }

            //actualizamos la condicion de la moto
            $moto = Moto::find($venta->id_moto);
            $moto->condicion = 'en_stock';
            $moto->fecha_venta_moto = null;
            $moto->save();

            $venta->delete();
        });



        return redirect()->back()
            ->with('mensaje', 'Credito y Venta eliminada correctamente.')
            ->with('icono', 'success');
    }
}
