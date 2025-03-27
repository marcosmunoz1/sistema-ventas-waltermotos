<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{
    public function index()
    {
       
        $usuarios = User::all();

        return view('admin.usuarios.index', compact('usuarios'));
    }
    
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        //$datos = $request->all();
        //return response()->json($datos, 200, [], JSON_PRETTY_PRINT);


        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);
        
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        $usuario->assignRole($request->role);
        
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario registrado con exíto')
            ->with('icono', 'success'); 

    }


    public function show($id)
    {
        //
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        //
        $usuario = User::find($id);
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario','roles'));
    }

    
    public function update(Request $request, $id)
    {
        //
        
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'confirmed',
        ]);

        $usuario = User::find($id);

        $usuario->name = $request->name;
        $usuario->email = $request->email; 
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
                
        $usuario->save();
        $usuario->syncRoles($request->role);
        
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se modificó al usuario de la manera correcta')
            ->with('icono', 'success');
    }

  
    public function destroy(string $id)
    {
        //
        User::destroy($id);
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se elimino el Usuario con exíto')
            ->with('icono','success');
    }
}
