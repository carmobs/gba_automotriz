<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Clientes;
use App\Models\Servicios;
use App\Models\Empleados;
use App\Models\Vehiculos;
use App\Models\Reparacion;
use App\Models\Pagos;

class CatalogosController extends Controller
{
    public function home():View
    {
        return view('home',["breadcrumbs"=>[]]);
    }

    public function clientesGet():View
    {
        $clientes = Clientes::all();
        return view('catalogos/clientesGet',[
            'clientes'=>$clientes,
            "breadcrumbs"=>[
                "inicio"=> url("/"),
                "clientes"=> url("/catalogos/clientes")
            ]
        ]);
    }

    public function clientesAgregarGet():View
    {
        return view('catalogos/clientesAgregarGet',[
            "breadcrumbs"=>[
                "inicio"=> url("/"),
                "clientes"=> url("/catalogos/clientes"),
                "Agregar"=> url("/catalogos/clientes/agregar")
            ]
        ]);
    }
    public function clientesAgregarPost(Request $request):RedirectResponse
    {
        $nombre = $request->input('nombre');
        $telefono = $request->input('telefono');
        $clientes = new Clientes([
            'nombre' => strtoupper($nombre),
            'telefono' => $telefono
        ]);
        $clientes->save();
        return redirect('/catalogos/clientes');
    }

    public function serviciosGet():View
    {
        $servicios = Servicios::all();
        return view('catalogos/serviciosGet',[
            'servicios'=>$servicios,
            "breadcrumbs"=>[
                "inicio"=> url("/"),
                "servicios"=> url("/catalogos/servicios")
            ]
        ]);
    }
    public function serviciosAgregarGet():View
    {
        return view('catalogos/serviciosAgregarGet',[
            "breadcrumbs"=>[
                "inicio"=> url("/"),
                "servicios"=> url("/catalogos/servicios"),
                "Agregar"=> url("/catalogos/servicios/agregar")
            ]
        ]);
    }
    public function serviciosAgregarPost(Request $request): RedirectResponse
    {
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $tiempo = $request->input('tiempo');
        $costo = $request->input('costo');

        // Convertir el tiempo a formato compatible con MySQL (24 horas)
        $tiempo_formateado = Carbon::parse($tiempo)->format('H:i:s');


        $servicios = new Servicios([
            'nombre' => strtoupper($nombre),
            'descripcion' => $descripcion,
            'tiempo' => $tiempo_formateado,
            'costo' => $costo
        ]);
        $servicios->save();

        return redirect('/catalogos/servicios');
    }


    public function empleadosGet():View
    {
        $empleados = Empleados::all();
        return view('catalogos/empleadosGet',[
            'empleados'=>$empleados,
            "breadcrumbs"=>[
                "inicio"=> url("/"),
                "servicios"=> url("/catalogos/empleados")
            ]
        ]);
    }
    public function empleadosAgregarGet():View
    {
        return view('catalogos/empleadosAgregarGet',[
            "breadcrumbs"=>[
                "inicio"=> url("/"),
                "servicios"=> url("/catalogos/empleados"),
                "Agregar"=> url("/catalogos/empleados/agregar")
            ]
        ]);
    }
    public function empleadosAgregarPost(Request $request): RedirectResponse
    {
        $nombre = $request->input('nombre');
        $fecha_ingreso = $request->input('fecha');
        $estado = $request->input('estado');
    
        $empleados = new Empleados([
            'nombre' => strtoupper($nombre),
            'fecha_ingreso' => $fecha_ingreso,
            'estado' => $estado
        ]);
        $empleados->save();
    
        return redirect('/catalogos/empleados');
    }

    public function vehiculosGet():View
    {
        $vehiculos = Vehiculos::join("clientes", "clientes.id_clientes", "=", "vehiculos.id_clientes")
            ->select("vehiculos.*", "clientes.nombre as cliente_nombre") // Obtener el nombre del cliente
            ->get();

        return view('catalogos/vehiculosGet', [
            'vehiculos' => $vehiculos,
            "breadcrumbs" => [
                "inicio" => url("/"),
                "vehiculos" => url("/catalogos/vehiculos")
            ]
        ]);
    }

    public function reparacionGet(): View
    {
        $reparaciones = Reparacion::join("clientes", "clientes.id_clientes", "=", "reparacion.id_clientes")
            ->join("empleados", "empleados.id_empleados", "=", "reparacion.id_empleados")
            ->select(
                "reparacion.*", 
                "clientes.nombre as cliente_nombre", 
                "empleados.nombre as empleado_nombre"
            )
            ->get();

        return view('catalogos/reparacionGet', [
            'reparaciones' => $reparaciones,
            "breadcrumbs" => [
                "inicio" => url("/"),
                "reparacion" => url("/catalogos/reparacion")
            ]
        ]);
    }

    public function pagosGet(): View
    {
        $pagos = Pagos::join("reparacion", "reparacion.id_reparacion", "=", "pagos.id_reparacion")
            ->join("clientes", "clientes.id_clientes", "=", "reparacion.id_clientes")
            ->select(
                "pagos.*", 
                "reparacion.id_reparacion", 
                "clientes.nombre as cliente_nombre"
            )
            ->get();

        return view('catalogos/pagosGet', [
            'pagos' => $pagos,
            "breadcrumbs" => [
                "inicio" => url("/"),
                "pagos" => url("/catalogos/pagos")
            ]
        ]);
    }

}
