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

Route::get('/catalogos/{category}/actualizar/{id}', [CatalogosController::class, 'actualizarGet'])->name('catalogos.actualizar.get');
Route::post('/catalogos/{category}/actualizar/{id}', [CatalogosController::class, 'actualizarPost'])->name('catalogos.actualizar.post');

Route::delete('/catalogos/clientes/{id}', [CatalogosController::class, 'clientesEliminar'])->name('clientes.destroy');
Route::delete('/catalogos/servicios/{id}', [CatalogosController::class, 'serviciosEliminar'])->name('servicios.destroy');
Route::delete('/catalogos/empleados/{id}', [CatalogosController::class, 'empleadosEliminar'])->name('empleados.destroy');
Route::delete('/catalogos/vehiculos/{id}', [CatalogosController::class, 'vehiculosEliminar'])->name('vehiculos.destroy');
Route::delete('/catalogos/reparacion/{id}', [CatalogosController::class, 'reparacionEliminar'])->name('reparacion.destroy');
Route::delete('/catalogos/pagos/{id}', [CatalogosController::class, 'pagosEliminar'])->name('pagos.destroy');