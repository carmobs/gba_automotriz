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
