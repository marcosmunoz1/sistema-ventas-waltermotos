<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TmpCompraController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home')->middleware('auth');;


//Rutas para roles
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth','can:roles-ver');
Route::post('admin/roles/crear-rol', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth','can:roles-crear');
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth','can:roles-editar');
Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth','can:roles-editar');
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth','can:roles-eliminar');
Route::get('/admin/roles/asignar/{id}', [App\Http\Controllers\RoleController::class, 'asignar'])->name('admin.roles.asignar')->middleware('auth','can:roles-asignar');
Route::put('/admin/roles/asignar/{id}', [App\Http\Controllers\RoleController::class, 'update_asignar'])->name('admin.roles.update_asignar')->middleware('auth','can:roles-asignar');


//Rutas para usuarios
Route::get('/admin/usuarios', [App\Http\Controllers\UsuariosController::class, 'index'])->name('admin.usuarios.index')->middleware('auth','can:usuarios-ver');
Route::get('/admin/usuarios/crear-usuario', [App\Http\Controllers\UsuariosController::class, 'create'])->name('admin.usuarios.create')->middleware('auth','can:usuarios-crear');
Route::post('admin/usuarios/crear-usuario', [App\Http\Controllers\UsuariosController::class, 'store'])->name('admin.usuarios.store')->middleware('auth','can:usuarios-crear');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuariosController::class, 'show'])->name('admin.usuarios.show')->middleware('auth','can:usuarios-ver');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuariosController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth','can:usuarios-editar');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuariosController::class, 'update'])->name('admin.usuarios.update')->middleware('auth','can:usuarios-editar');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuariosController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth','can:usuarios-eliminar');

//ruta para permisos
Route::get('/admin/permisos', [App\Http\Controllers\PermisoController::class, 'index'])->name('admin.permisos.index')->middleware('auth','can:permisos-ver');
Route::get('/admin/permisos/crear-permiso', [App\Http\Controllers\PermisoController::class, 'create'])->name('admin.permisos.create')->middleware('auth','can:permisos-crear');
Route::post('admin/permisos/crear-permiso', [App\Http\Controllers\PermisoController::class, 'store'])->name('admin.permisos.store')->middleware('auth','can:permisos-crear');
Route::get('/admin/permisos/{id}', [App\Http\Controllers\PermisoController::class, 'show'])->name('admin.permisos.show')->middleware('auth','can:permisos-ver');
Route::get('/admin/permisos/{id}/edit', [App\Http\Controllers\PermisoController::class, 'edit'])->name('admin.permisos.edit')->middleware('auth','can:permisos-editar');
Route::put('/admin/permisos/{id}', [App\Http\Controllers\PermisoController::class, 'update'])->name('admin.permisos.update')->middleware('auth','can:permisos-editar');
Route::delete('/admin/permisos/{id}', [App\Http\Controllers\PermisoController::class, 'destroy'])->name('admin.permisos.destroy')->middleware('auth','can:permisos-eliminar');


//Rutas para Motos
Route::get('/admin/motos', [App\Http\Controllers\MotoController::class, 'index'])->name('admin.motos.index')->middleware('auth','can:motos-ver');
Route::get('/admin/motos/crear-moto', [App\Http\Controllers\MotoController::class, 'create'])->name('admin.motos.create')->middleware('auth','can:motos-crear');
Route::post('admin/motos/crear-moto', [App\Http\Controllers\MotoController::class, 'store'])->name('admin.motos.store')->middleware('auth','can:motos-crear');
Route::get('/admin/motos/{id}', [App\Http\Controllers\MotoController::class, 'show'])->name('admin.motos.show')->middleware('auth','can:motos-ver');
Route::get('/admin/motos/{id}/edit', [App\Http\Controllers\MotoController::class, 'edit'])->name('admin.motos.edit')->middleware('auth','can:motos-editar');
Route::put('/admin/motos/{id}', [App\Http\Controllers\MotoController::class, 'update'])->name('admin.motos.update')->middleware('auth','can:motos-editar');
Route::delete('/admin/motos/{id}', [App\Http\Controllers\MotoController::class, 'destroy'])->name('admin.motos.destroy')->middleware('auth','can:motos-eliminar');


//Ruta para proveedores
Route::get('/admin/proveedores', [App\Http\Controllers\ProveedoresController::class, 'index'])->name('admin.proveedores.index')->middleware('auth','can:proveedores-ver');
Route::get('/admin/proveedores/crear-proveedor', [App\Http\Controllers\ProveedoresController::class, 'create'])->name('admin.proveedores.crear-proveedor')->middleware('auth','can:proveedores-crear');
Route::post('/admin/proveedores/cargar-proveedor', [App\Http\Controllers\ProveedoresController::class, 'store'])->name('store')->middleware('auth','can:proveedores-crear');
Route::delete('/admin/proveedores/{id}', [App\Http\Controllers\ProveedoresController::class, 'destroy'])->name('admin.proveedores.destroy')->middleware('auth','can:proveedores-eliminar');
//Agregar proveedor desde compras
Route::post('/proveedores/crear-para-compra', [App\Http\Controllers\ProveedoresController::class, 'crearProveedorCompra'])->name('proveedores.crearProveedorCompra')->middleware('auth','can:proveedores-crear');


//rutas para compras
Route::get('/admin/compras', [App\Http\Controllers\ComprasController::class, 'index'])->name('admin.compras.index')->middleware('auth','can:compras-ver');
Route::get('/admin/compras/create', [App\Http\Controllers\ComprasController::class, 'create'])->name('admin.compras.create')->middleware('auth','can:compras-crear');
Route::post('/admin/compras/create', [App\Http\Controllers\ComprasController::class, 'store'])->name('admin.compras.store')->middleware('auth','can:compras-crear');
Route::get('/admin/compras/{id}', [App\Http\Controllers\ComprasController::class, 'show'])->name('admin.compras.show')->middleware('auth','can:compras-ver');
Route::get('/admin/compras/{id}/edit', [App\Http\Controllers\ComprasController::class, 'edit'])->name('admin.compras.edit')->middleware('auth','can:compras-editar');
Route::put('/admin/compras/{id}', [App\Http\Controllers\ComprasController::class, 'update'])->name('admin.compras.update')->middleware('auth','can:compras-editar');
Route::delete('/admin/compras/{id}', [App\Http\Controllers\ComprasController::class, 'destroy'])->name('admin.compras.destroy')->middleware('auth','can:compras-eliminar');

//Rutas para editar datos de las motos de una compra
Route::get('/admin/compras/{compraId}/motos/{motoId}/editar', [App\Http\Controllers\ComprasController::class, 'editarMotoCompra'])->name('compras.motos.edit')->middleware('auth','can:compras-editar');
Route::put('/admin/compras/{compraId}/motos/{motoId}', [App\Http\Controllers\ComprasController::class, 'actualizarMotoCompra'])->name('compras.motos.update')->middleware('auth','can:compras-editar');
Route::post('/admin/compras/edit', [App\Http\Controllers\ComprasController::class, 'agregarMotoCompra'])->name('admin.compras.motos.create')->middleware('auth')->middleware('auth','can:compras-editar');
Route::delete('/admin/compras/motos/{id}', [App\Http\Controllers\ComprasController::class, 'eliminarMotoCompra'])->name('admin.compras.motos.destroy')->middleware('auth','can:compras-eliminar');

// EDITAR MOTO DE LA TABLA TEMPORAL
Route::get('/admin/motos-temporales/{motoId}/editar',[App\Http\Controllers\TmpCompraController::class, 'editarMoto'])->name('compras.temporales.motos.edit')->middleware('auth','can:compras-editar');
Route::put('/admin/motos-temporales/moto/{motoId}', [\App\Http\Controllers\TmpCompraController::class, 'update'])
    ->name('compras.temporales.motos.update');

//Rutas para tmp-motos
Route::middleware(['web', 'auth'])->post('/admin/tmp-compras', [TmpCompraController::class, 'store'])->name('tmp-compras.store');
Route::delete('/admin/tmp-compras/{id}', [TmpCompraController::class, 'destroy'])->name('tmp-compras.destroy')->middleware('auth');
Route::get('/admin/tmp-compras/motos', [TmpCompraController::class, 'getMotos'])->name('tmp-compras.getMotos')->middleware('auth');
Route::get('/admin/tmp-compras/listar', [TmpCompraController::class, 'listar'])->name('tmp-compras.listar')->middleware('auth');
Route::delete('/admin/tmp-compras/clear/{compraId}', [TmpCompraController::class, 'clear'])
    ->name('tmp-compras.clear')
    ->middleware('auth');


//Rutas para Ventas
Route::get('/admin/ventas', [App\Http\Controllers\VentaController::class, 'index'])->name('admin.ventas.index')->middleware('auth','can:ventas-ver');
Route::get('/admin/ventas/crear-venta', [App\Http\Controllers\VentaController::class, 'create'])->name('admin.ventas.create')->middleware('auth','can:ventas-crear');
Route::post('admin/ventas/crear-venta', [App\Http\Controllers\VentaController::class, 'store'])->name('admin.ventas.store')->middleware('auth','can:ventas-crear');
Route::get('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'show'])->name('admin.ventas.show')->middleware('auth','can:ventas-ver');
Route::get('/admin/ventas/{id}/edit', [App\Http\Controllers\VentaController::class, 'edit'])->name('admin.ventas.edit')->middleware('auth','can:ventas-editar');
Route::put('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'update'])->name('admin.ventas.update')->middleware('auth','can:ventas-editar');
Route::delete('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'destroy'])->name('admin.ventas.destroy')->middleware('auth','can:ventas-eliminar');
Route::get('/admin/ventas/reporte/{id}', [App\Http\Controllers\VentaController::class, 'reporte'])->name('admin.venta.reporte')->middleware('auth','can:ventas-ver');



//Rutas para Creditos
Route::get('/admin/creditos', [App\Http\Controllers\CreditoController::class, 'index'])->name('admin.creditos.index')->middleware('auth','can:creditos-ver');
Route::get('/admin/creditos/{id}/cobrar-cuotas', [App\Http\Controllers\CreditoController::class, 'create'])->name('admin.creditos.cobrar-cuotas.create')->middleware('auth','can:creditos-crear');
Route::post('/admin/creditos/cobrar-cuotas', [App\Http\Controllers\CreditoController::class, 'store'])->name('admin.creditos.cobrar-cuotas.store')->middleware('auth','can:creditos-crear');
Route::get('/admin/creditos/{id}', [App\Http\Controllers\CreditoController::class, 'show'])->name('admin.creditos.show')->middleware('auth','can:creditos-ver');
Route::get('/admin/creditos/{id}/edit', [App\Http\Controllers\CreditoController::class, 'edit'])->name('admin.creditos.edit')->middleware('auth','can:creditos-editar');
Route::put('/admin/creditos/{id}', [App\Http\Controllers\CreditoController::class, 'update'])->name('admin.creditos.update')->middleware('auth','can:creditos-editar');
Route::delete('/admin/creditos/{id}', [App\Http\Controllers\CreditoController::class, 'destroy'])->name('admin.creditos.destroy')->middleware('auth','can:creditos-eliminar');
Route::get('/admin/creditos/reporte/{id}', [App\Http\Controllers\CreditoController::class, 'reporte'])->name('admin.creditos.reporte')->middleware('auth','can:creditos-ver');
Route::get('/admin/creditos/resumen/{id}', [App\Http\Controllers\CreditoController::class, 'imprimirCredito'])->name('admin.creditos.resumen')->middleware('auth','can:creditos-ver');


//Rutas para clientes
Route::get('/admin/clientes', [App\Http\Controllers\ClientesController::class, 'index'])->name('admin.clientes.index')->middleware('auth','can:clientes-ver');
Route::get('admin/clientes/create', [App\Http\Controllers\ClientesController::class, 'create'])->name('admin.clientes.create')->middleware('auth','can:clientes-crear');
Route::post('admin/clientes/create', [App\Http\Controllers\ClientesController::class, 'store'])->name('admin.clientes.store')->middleware('auth','can:clientes-crear');
Route::get('/admin/clientes/{id}', [App\Http\Controllers\ClientesController::class, 'show'])->name('admin.clientes.show')->middleware('auth','can:clientes-ver');
Route::get('/admin/clientes/{id}/edit', [App\Http\Controllers\ClientesController::class, 'edit'])->name('admin.clientes.edit')->middleware('auth','can:clientes-editar');
Route::put('/admin/clientes/{id}', [App\Http\Controllers\ClientesController::class, 'update'])->name('admin.clientes.update')->middleware('auth','can:clientes-editar');
Route::delete('/admin/clientes/{id}', [App\Http\Controllers\ClientesController::class, 'destroy'])->name('admin.clientes.destroy')->middleware('auth','can:clientes-eliminar');




