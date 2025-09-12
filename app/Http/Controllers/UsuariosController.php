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
        $roles = Role::all();
        return view('admin.usuarios.index', compact('usuarios','roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        // Obtenemos el usuario logueado
        $userLogueado = Auth::user();

        // Buscamos el rol Super-Admin en la base
        $rolSuperAdmin = Role::where('name', 'Super-Admin')->first();

        // Bloquear asignación de Super-Admin si quien crea no es Super-Admin
        if ($rolSuperAdmin && strtolower($request->role) === strtolower($rolSuperAdmin->name)) {
            if (!$userLogueado || !$userLogueado->roles->contains($rolSuperAdmin->id)) {
                return redirect()->back()
                    ->with('mensaje', 'Solo el Super-Admin puede asignar el rol Super-Admin')
                    ->with('icono', 'error');
            }
        }

        // Crear usuario
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        // Asignar rol
        $usuario->assignRole($request->role);

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario registrado con éxito ✅')
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
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|confirmed',
            'role' => 'required|string',
        ]);

        $usuario = User::findOrFail($id);
        $userLogueado = Auth::user();
        $rolSuperAdmin = Role::where('name', 'Super-Admin')->first();

        if ($rolSuperAdmin) {
            $usuarioEsSuperAdmin = $usuario->roles->contains($rolSuperAdmin->id);
            $logueadoEsSuperAdmin = $userLogueado->roles->contains($rolSuperAdmin->id);

            // 🚫 Bloquear edición total si el usuario es Super-Admin y quien edita no lo es
            if ($usuarioEsSuperAdmin && !$logueadoEsSuperAdmin) {
                return redirect()->back()
                    ->with('mensaje', 'No podés editar a un Super-Admin 🚫')
                    ->with('icono', 'error');
            }

            // Bloquear que alguien asigne el rol Super-Admin si no es Super-Admin
            if (strtolower($request->role) === strtolower($rolSuperAdmin->name) && !$logueadoEsSuperAdmin) {
                return redirect()->back()
                    ->with('mensaje', 'Solo el Super-Admin puede asignar el rol Super-Admin ')
                    ->with('icono', 'error');
            }
        }

        // Actualizar datos
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();

        // Sincronizar rol permitido
        $usuario->syncRoles($request->role);

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se modificó al usuario correctamente ✅')
            ->with('icono', 'success');
    }



    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Si el usuario a eliminar es Super-Admin
        if ($user->hasRole('Super-Admin')) {
            // Solo puede borrarse a sí mismo
            if (Auth::id() !== $user->id) {
                return redirect()->route('admin.usuarios.index')
                    ->with('mensaje', 'Solo el Super-Admin puede borrarse a sí mismo')
                    ->with('icono', 'error');
            }
        }

        $user->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se eliminó el Usuario con éxito')
            ->with('icono', 'success');
    }
}
