<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogosController;

Route::get('/', function () {
    return view('home',["breadcrumbs" => []]);
});

Route::get("/catalogos/clientes", [CatalogosController::class, 'clientesGet']);

Route::get("/catalogos/servicios", [CatalogosController::class, 'serviciosGet']);

Route::get("/catalogos/empleados", [CatalogosController::class, 'empleadosGet'])->name('empleados.get');

Route::get("/catalogos/vehiculos", [CatalogosController::class, 'vehiculosGet']);

Route::get("/catalogos/reparacion", [CatalogosController::class, 'reparacionGet']);

Route::get("/catalogos/pagos", [CatalogosController::class, 'pagosGet']);

Route::get("/catalogos/clientes/agregar", [CatalogosController::class, 'clientesAgregarGet']);

Route::post("/catalogos/clientes/agregar", [CatalogosController::class, 'clientesAgregarPost']);

Route::get("/catalogos/empleados/agregar", [CatalogosController::class, 'empleadosAgregarGet']);

Route::post("/catalogos/empleados/agregar", [CatalogosController::class, 'empleadosAgregarPost']);

Route::get("/catalogos/servicios/agregar", [CatalogosController::class, 'serviciosAgregarGet']);

Route::post("/catalogos/servicios/agregar", [CatalogosController::class, 'serviciosAgregarPost']);

Route::get("/catalogos/vehiculos/agregar", [CatalogosController::class, 'vehiculosAgregarGet']);

Route::post("/catalogos/vehiculos/agregar", [CatalogosController::class, 'vehiculosAgregarPost']);

Route::get('/catalogos/pagos/agregar', [CatalogosController::class, 'pagosAgregarGet'])->name('pagos.create');

Route::post('/catalogos/pagos/agregar', [CatalogosController::class, 'pagosAgregarPost'])->name('pagos.store');

Route::get('/catalogos/reparacion/agregar', [CatalogosController::class, 'reparacionAgregarGet'])->name('reparacion.create');

Route::post('/catalogos/reparacion/agregar', [CatalogosController::class, 'reparacionAgregarPost'])->name('reparacion.store');

Route::get('/catalogos/orden_reparacion/ordenReparacionGet/{id_reparacion?}', [CatalogosController::class, 'ordenReparacionGet'])->name('orden_reparacion.get');

Route::get('/catalogos/orden_reparacion/agregar/{id_reparacion?}', [CatalogosController::class, 'ordenReparacionAgregarGet'])->name('orden_reparacion.create');

Route::post('/catalogos/orden_reparacion/agregar', [CatalogosController::class, 'ordenReparacionAgregarPost'])->name('orden_reparacion.store');

Route::get('/catalogos/{category}/actualizar/{id}', [CatalogosController::class, 'actualizarGet'])->name('catalogos.actualizar.get');
Route::post('/catalogos/{category}/actualizar/{id}', [CatalogosController::class, 'actualizarPost'])->name('catalogos.actualizar.post');

Route::delete('/catalogos/clientes/{id}', [CatalogosController::class, 'clientesEliminar'])->name('clientes.destroy');
Route::delete('/catalogos/servicios/{id}', [CatalogosController::class, 'serviciosEliminar'])->name('servicios.destroy');
Route::delete('/catalogos/empleados/{id}', [CatalogosController::class, 'empleadosEliminar'])->name('empleados.destroy');
Route::delete('/catalogos/vehiculos/{id}', [CatalogosController::class, 'vehiculosEliminar'])->name('vehiculos.destroy');
Route::delete('/catalogos/reparacion/{id}', [CatalogosController::class, 'reparacionEliminar'])->name('reparacion.destroy');
Route::delete('/catalogos/pagos/{id}', [CatalogosController::class, 'pagosEliminar'])->name('pagos.destroy');
Route::delete('/catalogos/orden_reparacion/{id}', [CatalogosController::class, 'ordenReparacionEliminar'])->name('orden_reparacion.destroy');

Route::get('/catalogos/citas', [CatalogosController::class, 'citasGet'])->name('citas.get');
Route::get('/catalogos/citas/agregar', [CatalogosController::class, 'citasAgregarGet'])->name('citas.create');
Route::post('/catalogos/citas/agregar', [CatalogosController::class, 'citasAgregarPost'])->name('citas.store');
Route::get('/catalogos/citas/actualizar/{id}', [CatalogosController::class, 'citasActualizarGet'])->name('citas.update.get');
Route::post('/catalogos/citas/actualizar/{id}', [CatalogosController::class, 'citasActualizarPost'])->name('citas.update.post');
Route::delete('/catalogos/citas/{id}', [CatalogosController::class, 'citasEliminar'])->name('citas.destroy');

Route::get('/catalogos/empleados/{id}/puestos', [CatalogosController::class, 'empleadoPuestosGet'])->name('empleados.puestos.get');
Route::get('/catalogos/empleados/{id}/puestos/agregar', [CatalogosController::class, 'empleadoPuestosAgregarGet'])->name('empleados.puestos.create');
Route::post('/catalogos/empleados/{id}/puestos/agregar', [CatalogosController::class, 'empleadoPuestosAgregarPost'])->name('empleados.puestos.store');

Route::get('/catalogos/puestos', [CatalogosController::class, 'puestosGet'])->name('puestos.get');
Route::get('/catalogos/puestos/agregar', [CatalogosController::class, 'puestosAgregarGet'])->name('puestos.create');
Route::post('/catalogos/puestos/agregar', [CatalogosController::class, 'puestosAgregarPost'])->name('puestos.store');
Route::get('/catalogos/puestos/actualizar/{id}', [CatalogosController::class, 'puestosActualizarGet'])->name('puestos.update.get');
Route::post('/catalogos/puestos/actualizar/{id}', [CatalogosController::class, 'puestosActualizarPost'])->name('puestos.update.post');
Route::delete('/catalogos/puestos/{id}', [CatalogosController::class, 'puestosEliminar'])->name('puestos.destroy');