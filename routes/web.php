<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogosController;

Route::get('/', function () {
    return view('home',["breadcrumbs" => []]);
});

Route::get("/catalogos/clientes", [CatalogosController::class, 'clientesGet']);

Route::get("/catalogos/servicios", [CatalogosController::class, 'serviciosGet']);

Route::get("/catalogos/empleados", [CatalogosController::class, 'empleadosGet']);

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
