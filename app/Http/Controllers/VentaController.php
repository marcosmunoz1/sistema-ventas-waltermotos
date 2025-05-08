<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Credito;
use App\Models\DetalleCredito;
use App\Models\Marca;
use App\Models\Moto;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('moto', 'cliente')->get();
        return view('admin.ventas.index', compact('ventas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $motos = Moto::whereNull('fecha_venta_moto')->with(['nacionalidad', 'marca'])->get();
        $clientes = Cliente::with('conyugue')->get(); 

        return view('admin.ventas.create', compact('clientes', 'motos'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_cliente'     => 'required|exists:clientes,id',
            'id_moto'        => 'required|exists:motos,id',
            'fecha'          => 'required|date',
            'forma_pago'     => 'required|in:Contado,Credito',
            'precio_venta'   => 'required|numeric|min:0',
            'entrega'        => 'nullable|numeric|min:0',
            'cuotas'         => 'nullable|integer|min:1',
            'interes'        => 'nullable|numeric|min:0',
            'valor_cuota'    => 'nullable|numeric|min:0',
        ]);

        $venta = new Venta();
        $venta->id_cliente   = $validated['id_cliente'];
        $venta->id_moto      = $validated['id_moto'];
        $venta->fecha_venta  = $validated['fecha'];
        $venta->forma_pago   = $validated['forma_pago'];

        if ($validated['forma_pago'] === 'Credito') {
            $entrega = $validated['entrega'] ?? 0;
            $cuotas = $validated['cuotas'];
            $valor_cuota = $validated['valor_cuota'];

            $venta->total_pago   = $entrega;
            $venta->precio_venta = $entrega + ($cuotas * $valor_cuota);
        } else {
            $venta->total_pago   = $validated['precio_venta'];
            $venta->precio_venta = $validated['precio_venta'];
        }

        $venta->save();

        if ($validated['forma_pago'] === 'Credito') {
            $credito = new Credito();
            $credito->id_venta         = $venta->id_venta;
            $credito->valor_financiado = $venta->precio_venta - $entrega;
            $credito->saldo_credito    = $credito->valor_financiado;
            $credito->entrega          = $entrega;
            $credito->cantidad_cuotas  = $cuotas;
            $credito->interes          = $validated['interes'];
            $credito->monto_cuota      = $valor_cuota;
            $credito->estado_credito   = 'Pendiente';
            $credito->save();


            $fechaVencimiento = Carbon::parse($venta->fecha_venta)->addMonth();

            for ($i = 1; $i <= $credito->cantidad_cuotas; $i++) {
                $detalle = new DetalleCredito();
                $detalle->id_credito        = $credito->id;
                $detalle->numero_cuota      = $i;
                $detalle->valor_cuota       = $credito->monto_cuota;
                $detalle->fecha_vencimiento = $fechaVencimiento->copy()->addMonthsNoOverflow($i - 1);
                $detalle->estado_cuota      = 'Pendiente';
                $detalle->save();
            }
        }

        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'Venta registrada con éxito')
            ->with('icono', 'success');
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $venta = Venta::find($id);
        $cliente = Cliente::with('conyugue')->where('id', $venta->id_cliente)->first();
        $moto = Moto::with('marca','nacionalidad')->where('id', $venta->id_moto)->first();
        if ($venta->forma_pago === 'Credito') {
            $credito = Credito::with('detalles')->where('id_venta', $venta->id_venta)->first();

            return view('admin.ventas.show_credito', compact('venta', 'credito', 'cliente','moto'));
        } else {
            return view('admin.ventas.show', compact('venta', 'cliente','moto'));
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
