<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas para roles
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index');
Route::get('/admin/roles/crear-rol', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create');
Route::post('admin/roles/crear-rol', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store');
Route::get('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('admin.roles.show');
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit');
Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update');
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy');
Route::get('/admin/roles/asignar/{id}', [App\Http\Controllers\RoleController::class, 'asignar'])->name('admin.roles.asignar');
Route::put('/admin/roles/asignar/{id}', [App\Http\Controllers\RoleController::class, 'update_asignar'])->name('admin.roles.update_asignar');


//Rutas para usuarios
Route::get('/admin/usuarios', [App\Http\Controllers\UsuariosController::class, 'index'])->name('admin.usuarios.index');
Route::get('/admin/usuarios/crear-usuario', [App\Http\Controllers\UsuariosController::class, 'create'])->name('admin.usuarios.create');
Route::post('admin/usuarios/crear-usuario', [App\Http\Controllers\UsuariosController::class, 'store'])->name('admin.usuarios.store');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuariosController::class, 'show'])->name('admin.usuarios.show');  
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuariosController::class, 'edit'])->name('admin.usuarios.edit');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuariosController::class, 'update'])->name('admin.usuarios.update');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuariosController::class, 'destroy'])->name('admin.usuarios.destroy');


Route::get('/proveedores', [App\Http\Controllers\ProveedoresController::class, 'index'])->name('index');
