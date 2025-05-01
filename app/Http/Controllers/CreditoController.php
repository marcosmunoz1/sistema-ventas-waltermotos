<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Venta;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    //
    public function index()
    {    
        $creditos = Credito::with('detalles', 'venta') ->get();
        return view('admin.creditos.index', compact('creditos'));
    }

    public function show($id)
    {    
        $credito = Credito::with('detalles','venta')->where('id', $id)->first();
        return view('admin.creditos.show', compact('credito'));
    }

    public function create($id)
    {    
        $credito = Credito::with('detalles','venta')->where('id', $id)->first();
        return view('admin.creditos.cobrar-cuotas', compact('credito'));
    }
}
