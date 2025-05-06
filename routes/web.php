<?php

use App\Http\Controllers\ComprasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas para roles
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index');
Route::post('admin/roles/crear-rol', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store');
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

//Rutas para Motos
Route::get('/admin/motos', [App\Http\Controllers\MotoController::class, 'index'])->name('admin.motos.index');
Route::get('/admin/motos/crear-moto', [App\Http\Controllers\MotoController::class, 'create'])->name('admin.motos.create');
Route::post('admin/motos/crear-moto', [App\Http\Controllers\MotoController::class, 'store'])->name('admin.motos.store');
Route::get('/admin/motos/{id}', [App\Http\Controllers\MotoController::class, 'show'])->name('admin.motos.show');
Route::get('/admin/motos/{id}/edit', [App\Http\Controllers\MotoController::class, 'edit'])->name('admin.motos.edit');
Route::put('/admin/motos/{id}', [App\Http\Controllers\MotoController::class, 'update'])->name('admin.motos.update');
Route::delete('/admin/motos/{id}', [App\Http\Controllers\MotoController::class, 'destroy'])->name('admin.motos.destroy');



Route::get('/proveedores', [App\Http\Controllers\ProveedoresController::class, 'index'])->name('index');

Route::get('/compras', [App\Http\Controllers\ComprasController::class, 'index'])->name('admin.compras.index');
Route::get('/admin/compras/crear-compra', [App\Http\Controllers\ComprasController::class, 'create'])->name('admin.compras.create')->middleware('auth');
Route::post('/admin/compras/cargar-compra', [App\Http\Controllers\ComprasController::class, 'store'])->name('admin.compras.store')->middleware('auth'); //ruta para enviar la informacion del nuevo rol
Route::get('/admin/compras/{id}', [App\Http\Controllers\ComprasController::class, 'show'])->name('admin.compras.show')->middleware('auth');
Route::get('/admin/compras/{id}/edit', [App\Http\Controllers\ComprasController::class, 'edit'])->name('admin.compras.edit')->middleware('auth');
Route::put('/admin/productos/{id}', [App\Http\Controllers\ComprasController::class, 'update'])->name('admin.compras.update')->middleware('auth');
Route::post('/admin/agregar-moto', [ComprasController::class, 'agregarMoto'])->name('agregar-moto');
Route::post('admin/eliminar-moto', [ComprasController::class, 'eliminarMoto']);
 /* Route::get('/admin/compras/reporte', [App\Http\Controllers\ComprasController::class, 'reporte'])->name('admin.compras.reporte')->middleware('auth','can:Ver reporte de compras');
Route::get('/admin/compras/{id}', [App\Http\Controllers\ComprasController::class, 'show'])->name('admin.compras.show')->middleware('auth','can:Ver datos de compra');
Route::get('/admin/compras/{id}/edit', [App\Http\Controllers\ComprasController::class, 'edit'])->name('admin.compras.edit')->middleware('auth','can:Editar compra');
Route::put('/admin/compras/{id}', [App\Http\Controllers\ComprasController::class, 'update'])->name('admin.compras.update')->middleware('auth');
Route::delete('/admin/compras/{id}', [App\Http\Controllers\ComprasController::class, 'destroy'])->name('admin.compras.destroy')->middleware('auth','can:Eliminar compra'); */


//Rutas para Ventas
Route::get('/admin/ventas', [App\Http\Controllers\VentaController::class, 'index'])->name('admin.ventas.index');
Route::get('/admin/ventas/crear-venta', [App\Http\Controllers\VentaController::class, 'create'])->name('admin.ventas.create');
Route::post('admin/ventas/crear-venta', [App\Http\Controllers\VentaController::class, 'store'])->name('admin.ventas.store');
Route::get('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'show'])->name('admin.ventas.show');
Route::get('/admin/ventas/{id}/edit', [App\Http\Controllers\VentaController::class, 'edit'])->name('admin.ventas.edit');
Route::put('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'update'])->name('admin.ventas.update');
Route::delete('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'destroy'])->name('admin.ventas.destroy');

//Rutas para clientes
Route::get('/admin/clientes', [App\Http\Controllers\ClientesController::class, 'index'])->name('admin.clientes.index');
Route::get('admin/clientes/create', [App\Http\Controllers\ClientesController::class, 'create'])->name('admin.clientes.create');
Route::post('admin/clientes/create', [App\Http\Controllers\ClientesController::class, 'store'])->name('admin.clientes.store');
Route::get('/admin/clientes/{id}/edit', [App\Http\Controllers\ClientesController::class, 'edit'])->name('admin.clientes.edit');
Route::put('/admin/clientes/{id}', [App\Http\Controllers\ClientesController::class, 'update'])->name('admin.clientes.update');
Route::delete('/admin/clientes/{id}', [App\Http\Controllers\ClientesController::class, 'destroy'])->name('admin.clientes.destroy');


