<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogosController;

Route::get('/', [CatalogosController::class, 'home'])->name('home');

// Rutas para Servicios
Route::prefix('/catalogos/servicios')->group(function () {
    Route::get('/', [CatalogosController::class, 'serviciosGet'])->name('servicios.get');
    Route::get('/agregar', [CatalogosController::class, 'serviciosAgregarGet'])->name('servicios.create');
    Route::post('/agregar', [CatalogosController::class, 'serviciosAgregarPost'])->name('servicios.store');
    Route::get('/actualizar/{id}', [CatalogosController::class, 'serviciosActualizarGet'])->name('servicios.update.get');
    Route::post('/actualizar/{id}', [CatalogosController::class, 'serviciosActualizarPost'])->name('servicios.update.post');
    Route::delete('/{id}', [CatalogosController::class, 'serviciosEliminar'])->name('servicios.destroy');
});

// Rutas para Clientes
Route::prefix('/catalogos/clientes')->group(function () {
    Route::get('/', [CatalogosController::class, 'clientesGet'])->name('clientes.get');
    Route::get('/agregar', [CatalogosController::class, 'clientesAgregarGet'])->name('clientes.create');
    Route::post('/agregar', [CatalogosController::class, 'clientesAgregarPost'])->name('clientes.store');
    Route::get('/actualizar/{id}', [CatalogosController::class, 'clientesActualizarGet'])->name('clientes.update.get');
    Route::post('/actualizar/{id}', [CatalogosController::class, 'clientesActualizarPost'])->name('clientes.update.post');
    Route::delete('/{id}', [CatalogosController::class, 'clientesEliminar'])->name('clientes.destroy');
});

// Rutas para Vehículos
Route::prefix('/catalogos/vehiculos')->group(function () {
    Route::get('/', [CatalogosController::class, 'vehiculosGet'])->name('vehiculos.get');
    Route::get('/agregar', [CatalogosController::class, 'vehiculosAgregarGet'])->name('vehiculos.create');
    Route::post('/agregar', [CatalogosController::class, 'vehiculosAgregarPost'])->name('vehiculos.store');
    Route::get('/actualizar/{id}', [CatalogosController::class, 'vehiculosActualizarGet'])->name('vehiculos.update.get');
    Route::post('/actualizar/{id}', [CatalogosController::class, 'vehiculosActualizarPost'])->name('vehiculos.update.post');
    Route::delete('/{id}', [CatalogosController::class, 'vehiculosEliminar'])->name('vehiculos.destroy');
});

// Rutas para Empleados
Route::prefix('/catalogos/empleados')->group(function () {
    Route::get('/', [CatalogosController::class, 'empleadosGet'])->name('empleados.get');
    Route::get('/agregar', [CatalogosController::class, 'empleadosAgregarGet'])->name('empleados.create');
    Route::post('/agregar', [CatalogosController::class, 'empleadosAgregarPost'])->name('empleados.store');
    Route::get('/actualizar/{id}', [CatalogosController::class, 'empleadosActualizarGet'])->name('empleados.update.get');
    Route::post('/actualizar/{id}', [CatalogosController::class, 'empleadosActualizarPost'])->name('empleados.update.post');
    Route::delete('/{id}', [CatalogosController::class, 'empleadosEliminar'])->name('empleados.destroy');
    
    // Rutas para Puestos de Empleados
    Route::get('/{id}/puestos', [CatalogosController::class, 'empleadoPuestosGet'])->name('empleados.puestos.get');
    Route::get('/{id}/puestos/agregar', [CatalogosController::class, 'empleadoPuestosAgregarGet'])->name('empleados.puestos.create');
    Route::post('/{id}/puestos', [CatalogosController::class, 'empleadoPuestosAgregarPost'])->name('empleados.puestos.store');
});

// Rutas para Reparaciones
Route::prefix('/catalogos/reparacion')->group(function () {
    Route::get('/', [CatalogosController::class, 'reparacionGet'])->name('reparacion.get');
    Route::get('/agregar', [CatalogosController::class, 'reparacionAgregarGet'])->name('reparacion.create');
    Route::post('/agregar', [CatalogosController::class, 'reparacionAgregarPost'])->name('reparacion.store');
    Route::get('/actualizar/{id}', [CatalogosController::class, 'reparacionActualizarGet'])->name('reparacion.update.get');
    Route::post('/actualizar/{id}', [CatalogosController::class, 'reparacionActualizarPost'])->name('reparacion.update.post');
    Route::delete('/{id}', [CatalogosController::class, 'reparacionEliminar'])->name('reparacion.destroy');
});

// Rutas para Órdenes de Reparación
Route::prefix('/catalogos/orden_reparacion')->group(function () {
    Route::get('/ordenReparacionGet/{id_reparacion?}', [CatalogosController::class, 'ordenReparacionGet'])->name('orden_reparacion.get');
    Route::get('/agregar/{id_reparacion}', [CatalogosController::class, 'ordenReparacionAgregarGet'])->name('orden_reparacion.create');
    Route::post('/agregar', [CatalogosController::class, 'ordenReparacionAgregarPost'])->name('orden_reparacion.store');
    Route::get('/actualizar/{id}', [CatalogosController::class, 'ordenReparacionActualizarGet'])->name('orden_reparacion.update.get');
    Route::post('/actualizar/{id}', [CatalogosController::class, 'ordenReparacionActualizarPost'])->name('orden_reparacion.update.post');
    Route::delete('/{id}', [CatalogosController::class, 'ordenReparacionEliminar'])->name('orden_reparacion.destroy');
    Route::post('/update-estado', [CatalogosController::class, 'ordenReparacionUpdateEstado'])->name('orden_reparacion.update.estado');
});

// Rutas para Pagos
Route::prefix('/catalogos/pagos')->group(function () {
    Route::get('/', [CatalogosController::class, 'pagosGet'])->name('pagos.get');
    Route::get('/agregar', [CatalogosController::class, 'pagosAgregarGet'])->name('pagos.create');
    Route::post('/agregar', [CatalogosController::class, 'pagosAgregarPost'])->name('pagos.store');
    Route::get('/actualizar/{id}', [CatalogosController::class, 'pagosActualizarGet'])->name('pagos.update.get');
    Route::post('/actualizar/{id}', [CatalogosController::class, 'pagosActualizarPost'])->name('pagos.update.post');
    Route::delete('/{id}', [CatalogosController::class, 'pagosEliminar'])->name('pagos.destroy');
    Route::get('/getReparacionInfo/{id_vehiculo}', [CatalogosController::class, 'getReparacionInfo']);
});

// Rutas para Citas
Route::prefix('/catalogos/citas')->group(function () {
    Route::get('/', [CatalogosController::class, 'citasGet'])->name('citas.get');
    Route::get('/agregar', [CatalogosController::class, 'citasAgregarGet'])->name('citas.create');
    Route::post('/agregar', [CatalogosController::class, 'citasAgregarPost'])->name('citas.store');
    Route::get('/actualizar/{id}', [CatalogosController::class, 'citasActualizarGet'])->name('citas.update.get');
    Route::post('/actualizar/{id}', [CatalogosController::class, 'citasActualizarPost'])->name('citas.update.post');
    Route::delete('/{id}', [CatalogosController::class, 'citasEliminar'])->name('citas.destroy');
});

// Rutas para Puestos
Route::prefix('/catalogos/puestos')->group(function () {
    Route::get('/', [CatalogosController::class, 'puestosGet'])->name('puestos.get');
    Route::get('/agregar', [CatalogosController::class, 'puestosAgregarGet'])->name('puestos.create');
    Route::post('/agregar', [CatalogosController::class, 'puestosAgregarPost'])->name('puestos.store');
    Route::get('/actualizar/{id}', [CatalogosController::class, 'puestosActualizarGet'])->name('puestos.update.get');
    Route::post('/actualizar/{id}', [CatalogosController::class, 'puestosActualizarPost'])->name('puestos.update.post');
    Route::delete('/{id}', [CatalogosController::class, 'puestosEliminar'])->name('puestos.destroy');
});

// Rutas para Reportes
Route::prefix('/catalogos/reportes')->group(function () {
    Route::get('/', [CatalogosController::class, 'reportesGet'])->name('reportes.get');
    Route::match(['get', 'post'], '/citas', [CatalogosController::class, 'reporteCitas'])->name('reportes.citas');
    Route::match(['get', 'post'], '/pagos', [CatalogosController::class, 'reportePagos'])->name('reportes.pagos');
    Route::match(['get', 'post'], '/reparaciones', [CatalogosController::class, 'reporteReparaciones'])->name('reportes.reparaciones');
});