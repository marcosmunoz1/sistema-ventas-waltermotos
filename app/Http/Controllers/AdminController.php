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
      
        return view('admin.index', compact(
            'cantidadRoles', 
            'cantidadUsuarios', 
            'cantidadProveedores',
            'cantidadCompras',
            'cantidadClientes',
            'cantidadVentas',
            'cantidadCreditos', // <- corregido aquí
            'cantidadMarcas',
            'cantidadMotos'
        ));

    }
}
