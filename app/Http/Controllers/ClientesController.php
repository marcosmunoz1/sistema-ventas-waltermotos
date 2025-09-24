<?php

namespace App\Http\Controllers;

use App\Enums\EstadoCivil;

use App\Models\Cliente;
use App\Models\Conyugue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $valores = EstadoCivil::cases(); // Devuelve un array de objetos EstadoCivil
        return view('admin.clientes.create', compact('valores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Primero validamos el cliente (los datos básicos)
        $request->validate([
            'nombre_cliente' => 'required',
            'apellido_cliente' => 'required',
            'cuit_cliente' => 'required|unique:clientes,cuit_cliente',
            'dni_cliente' => 'required|unique:clientes,dni_cliente',
            'fecha_nacimiento_cliente' => 'required',
            'celular_cliente' => 'required',
            'email_cliente' => 'required|email|unique:clientes,email_cliente',
            'estado_civil_cliente' => 'required',
            'calle' => 'required',
            'ciudad' => 'required',
            'provincia' => 'required',
            'profesion' => 'required',
        ]);

        // Si el estado civil es Casado o En Concubinato, validamos datos de cónyuge
        if (in_array($request->estado_civil_cliente, ['Casado', 'En Concubinato'])) {
            $validator = Validator::make($request->all(), [
                'nombre_conyugue' => 'required|string',
                'apellido_conyugue' => 'required|string',
                'dni_conyugue' => 'required|numeric|unique:conyugues,dni_conyugue',
                'fecha_nacimiento_conyugue' => 'required|date',
                'celular_conyugue' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error_conyugue', 'Debe completar todos los datos del cónyuge.');
            }
        } else {
            // Si no está en estado civil conyugal, borramos datos de conyugue para no guardar nada
            $request->merge([
                'nombre_conyugue' => null,
                'apellido_conyugue' => null,
                'dni_conyugue' => null,
                'fecha_nacimiento_conyugue' => null,
                'celular_conyugue' => null,
            ]);
        }

        // Guardamos cónyuge solo si corresponde
        $conyugueId = null;
        if (in_array($request->estado_civil_cliente, ['Casado', 'En Concubinato']) && $request->filled('nombre_conyugue')) {
            $conyugue = new Conyugue();
            $conyugue->nombre_conyugue = $request->nombre_conyugue;
            $conyugue->apellido_conyugue = $request->apellido_conyugue;
            $conyugue->dni_conyugue = $request->dni_conyugue;
            $conyugue->fecha_nacimiento_conyugue = $request->fecha_nacimiento_conyugue;
            $conyugue->celular_conyugue = $request->celular_conyugue;
            $conyugue->save();

            $conyugueId = $conyugue->id;
        }

        // Guardamos cliente
        $cliente = new Cliente();
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->apellido_cliente = $request->apellido_cliente;
        $cliente->cuit_cliente = $request->cuit_cliente;
        $cliente->dni_cliente = $request->dni_cliente;
        $cliente->fecha_nacimiento_cliente = $request->fecha_nacimiento_cliente;
        $cliente->celular_cliente = $request->celular_cliente;
        $cliente->email_cliente = $request->email_cliente;
        $cliente->estado_civil_cliente = $request->estado_civil_cliente;
        $cliente->calle = $request->calle;
        $cliente->ciudad = $request->ciudad;
        $cliente->provincia = $request->provincia;
        $cliente->profesion = $request->profesion;

        if ($conyugueId) {
            $cliente->id_conyugue_cliente = $conyugueId;
        } else {
            $cliente->id_conyugue_cliente = null;  // Aseguramos que no quede algo raro
        }

        $cliente->save();

        // Tomamos el redirect de la URL si existe
        $redirect = $request->input('redirect');

        if ($redirect) {
            if ($redirect && $redirect == 'admin.ventas.create') {
                $clienteConDatos = $cliente->load('conyugue');

                if ($clienteConDatos->conyugue) {
                    $clienteConDatos->conyugue_nombre_completo = $clienteConDatos->conyugue->apellido_conyugue . ', ' . $clienteConDatos->conyugue->nombre_conyugue;
                    $clienteConDatos->conyugue_celular = $clienteConDatos->conyugue->celular_conyugue;
                    $clienteConDatos->conyugue_fecha_nacimiento = $clienteConDatos->conyugue->fecha_nacimiento_conyugue;
                    $clienteConDatos->conyugue_dni = $clienteConDatos->conyugue->dni_conyugue;
                } else {
                    $clienteConDatos->conyugue_nombre_completo = null;
                    $clienteConDatos->conyugue_celular = null;
                    $clienteConDatos->conyugue_fecha_nacimiento = null;
                    $clienteConDatos->conyugue_dni = null;
                }

                return redirect()->route($redirect)->with('cliente_nuevo', $clienteConDatos);
            }
        } else {
            return redirect()->route('admin.clientes.index')
                ->with('mensaje', 'El cliente se agregó con éxito')
                ->with('icono', 'success');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $valores = EstadoCivil::cases(); // Devuelve un array de objetos EstadoCivil
        $cliente = Cliente::with('conyugue')->findOrFail($id);
        return view('admin.clientes.show', compact('cliente', 'valores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $valores = EstadoCivil::cases(); // Devuelve un array de objetos EstadoCivil
        $cliente = Cliente::with('conyugue')->findOrFail($id);
        return view('admin.clientes.edit', compact('cliente', 'valores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_cliente' => 'required',
            'apellido_cliente' => 'required',
            'cuit_cliente' => 'required|unique:clientes,cuit_cliente,' . $id,
            'dni_cliente' => 'required|unique:clientes,dni_cliente,' . $id,
            'fecha_nacimiento_cliente' => 'required|date',
            'celular_cliente' => 'required',
            'email_cliente' => 'required|email|unique:clientes,email_cliente,' . $id,
            'estado_civil_cliente' => 'required',
            'calle' => 'required',
            'ciudad' => 'required',
            'provincia' => 'required',
            'profesion' => 'required',
        ]);

        $cliente = Cliente::findOrFail($id);

        // Actualizar datos del cliente
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->apellido_cliente = $request->apellido_cliente;
        $cliente->cuit_cliente = $request->cuit_cliente;
        $cliente->dni_cliente = $request->dni_cliente;
        $cliente->fecha_nacimiento_cliente = $request->fecha_nacimiento_cliente;
        $cliente->celular_cliente = $request->celular_cliente;
        $cliente->email_cliente = $request->email_cliente;
        $cliente->estado_civil_cliente = $request->estado_civil_cliente;
        $cliente->calle = $request->calle;
        $cliente->ciudad = $request->ciudad;
        $cliente->provincia = $request->provincia;
        $cliente->profesion = $request->profesion;

        // Si es Casado o En Concubinato → validar y guardar cónyuge
        if (in_array($request->estado_civil_cliente, ['Casado', 'En Concubinato'])) {
            $request->validate([
                'nombre_conyugue' => 'required|string',
                'apellido_conyugue' => 'required|string',
                'dni_conyugue' => 'required|numeric|unique:conyugues,dni_conyugue,' . ($cliente->conyugue->id ?? 'null'),
                'fecha_nacimiento_conyugue' => 'nullable|date',
                'celular_conyugue' => 'nullable|string',
            ]);

            if ($cliente->id_conyugue_cliente) {
                // Actualizar cónyuge existente
                $conyugue = Conyugue::find($cliente->id_conyugue_cliente);
            } else {
                // Crear nuevo cónyuge
                $conyugue = new Conyugue();
            }

            $conyugue->nombre_conyugue = $request->nombre_conyugue;
            $conyugue->apellido_conyugue = $request->apellido_conyugue;
            $conyugue->dni_conyugue = $request->dni_conyugue;
            $conyugue->fecha_nacimiento_conyugue = $request->fecha_nacimiento_conyugue;
            $conyugue->celular_conyugue = $request->celular_conyugue;
            $conyugue->save();

            // Vincular con el cliente
            $cliente->id_conyugue_cliente = $conyugue->id;
        } else {
            // Si cambia a otro estado civil y tenía cónyuge, eliminarlo
            if ($cliente->id_conyugue_cliente) {
                Conyugue::where('id', $cliente->id_conyugue_cliente)->delete();
                $cliente->id_conyugue_cliente = null;
            }
        }

        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente actualizado correctamente')
            ->with('icono', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        // Si tiene cónyuge, lo eliminamos también
        if ($cliente->id_conyugue_cliente) {
            $conyugue = $cliente->conyugue;
            if ($conyugue) {
                $conyugue->delete();
            }
        }

        $cliente->delete();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Se eliminó al cliente de la manera correcta')
            ->with('icono', 'success');
    }
}
