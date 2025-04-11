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

        // Crear nueva venta
        $venta = new Venta();
        $venta->id_cliente   = $validated['id_cliente'];
        $venta->id_moto      = $validated['id_moto'];
        $venta->fecha_venta  = $validated['fecha'];
        $venta->forma_pago   = $validated['forma_pago'];
        $venta->precio_venta = $validated['precio_venta'];
        $venta->total_pago   = 0; // Al inicio, total_pago es 0
        $venta->save();

        if ($validated['forma_pago'] === 'Credito') {
            // Crear el crédito
            $credito = new Credito();
            $credito->id_venta         = $venta->id;
            $credito->valor_financiado = $venta->precio_venta - $validated['entrega'];
            $credito->saldo_credito    = $credito->valor_financiado; // Al inicio, saldo_credito es igual al financiado
            $credito->cantidad_cuotas  = $validated['cuotas'];
            $credito->interes          = $validated['interes'];
            $credito->monto_cuota      = $validated['valor_cuota'];
            $credito->estado_credito   = 'Pendiente';
            $credito->save();

            // Crear los detalles del crédito (una cuota por cada mes)
            $fechaVencimiento = Carbon::parse($venta->fecha); // Primera cuota vence el mismo mes de la venta
            for ($i = 1; $i <= $credito->cantidad_cuotas; $i++) {
                $detalle = new DetalleCredito();
                $detalle->id_credito        = $credito->id;
                $detalle->numero_cuota      = $i;
                $detalle->valor_cuota       = $credito->monto_cuota;
                $detalle->fecha_vencimiento = $fechaVencimiento->copy()->addMonth($i); // Sumar un mes completo
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
    public function show(Venta $venta)
    {
        //
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
