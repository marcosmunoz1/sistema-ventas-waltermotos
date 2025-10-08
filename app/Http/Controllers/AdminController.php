<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Credito;
use App\Models\Marca;
use App\Models\Moto;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $cantidadRoles = Role::count();
        $cantidadUsuarios = User::count();
        $cantidadMarcas = Marca::count();
        $cantidadMotos  = Moto::count();
        $cantidadProveedores  = Proveedor::count();
        $cantidadCompras  = Compra::count();
        $cantidadClientes = Cliente::count();
        $cantidadVentas = Venta::count();
        $cantidadCreditos = Credito::count();
        $ventas = Venta::all();
        $creditos = Credito::all();

        $morosos = Credito::with(['detalles', 'venta'])
            ->get()
            ->filter(function ($credito) {
                return $credito->detalles->filter(function ($detalle) {
                    return $detalle->estado_cuota === 'Pendiente' && $detalle->fecha_vencimiento < now();
                })->count() > 0;
            })
            ->sortByDesc(function ($credito) {
                return $credito->detalles->filter(function ($detalle) {
                    return $detalle->estado_cuota === 'Pendiente' && $detalle->fecha_vencimiento < now();
                })->count();
            });

        // Asegurarte que siempre es Collection
        $morosos = $morosos ?? collect();




        return view('admin.index', compact(
            'cantidadRoles',
            'cantidadUsuarios',
            'cantidadProveedores',
            'cantidadCompras',
            'cantidadClientes',
            'cantidadVentas',
            'cantidadCreditos', // <- corregido aquí
            'cantidadMarcas',
            'cantidadMotos',
            'ventas',
            'creditos',
            'morosos'
        ));
    }
}
