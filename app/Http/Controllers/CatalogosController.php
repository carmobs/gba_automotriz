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
use App\Models\Orden_Reparacion;

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

    public function clientesEliminar($id)
    {
        try {
            $cliente = Clientes::findOrFail($id);
            $cliente->delete(); 

            return redirect()->route('clientes.get')->with('success', 'Cliente eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el cliente: ' . $e->getMessage());
        }
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

    public function serviciosEliminar($id): RedirectResponse
    {
        try {
            $servicio = Servicios::findOrFail($id);
            $servicio->delete();

            return redirect()->route('servicios.get')->with('success', 'Servicio eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el servicio: ' . $e->getMessage());
        }
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

    public function empleadosEliminar($id): RedirectResponse
    {
        try {
            logger()->info("Attempting to delete empleado with ID: $id");

            $empleado = Empleados::findOrFail($id);
            $empleado->delete();

            logger()->info("Empleado with ID: $id deleted successfully");

            return redirect()->route('empleados.get')->with('success', 'Empleado eliminado correctamente');
        } catch (\Exception $e) {
            logger()->error("Error deleting empleado with ID: $id - " . $e->getMessage());
            return redirect()->back()->with('error', 'Error al eliminar el empleado: ' . $e->getMessage());
        }
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
    public function vehiculosAgregarGet(): View
    {
        // Obtener todos los clientes para el dropdown
        $clientes = Clientes::all(); // Asegúrate de importar el modelo Cliente al inicio del archivo
        
        return view('catalogos/vehiculosAgregarGet', [
            "breadcrumbs" => [
                "inicio" => url("/"),
                "vehiculos" => url("/catalogos/vehiculos"),
                "Agregar" => url("/catalogos/vehiculos/agregar")
            ],
            "clientes" => $clientes // Pasar los clientes a la vista
        ]);
    }
    
    public function vehiculosAgregarPost(Request $request): RedirectResponse
    {
        // Debug inicial (eliminar después de verificar)
        logger()->debug('Datos recibidos:', $request->all());
        
        // Validación modificada
        $validated = $request->validate([
            'id_clientes' => 'required|exists:clientes,id_clientes',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'anio_field' => 'required|integer|min:1900|max:'.(date('Y')+2),
            'detalles_vehiculo' => 'nullable|string|max:100'
        ]);
    
        // Conversión explícita
        $anioValue = (int)$validated['anio_field'];
    
        try {
            // Opción 1: Usando Eloquent
            $vehiculo = new Vehiculos();
            $vehiculo->id_clientes = $validated['id_clientes'];
            $vehiculo->marca = strtoupper($validated['marca']);
            $vehiculo->modelo = strtoupper($validated['modelo']);
            $vehiculo->año = $anioValue; // Nombre exacto de la columna
            $vehiculo->detalles_vehiculo = $validated['detalles_vehiculo'];
            
            if($vehiculo->save()) {
                return redirect('/catalogos/vehiculos')->with('success', 'Vehículo guardado');
            }
    
            // Opción 2: Usando Query Builder (si falla Eloquent)
            DB::table('vehiculos')->insert([
                'id_clientes' => $validated['id_clientes'],
                'marca' => strtoupper($validated['marca']),
                'modelo' => strtoupper($validated['modelo']),
                'año' => $anioValue,
                'detalles_vehiculo' => $validated['detalles_vehiculo']
            ]);
    
            return redirect('/catalogos/vehiculos')->with('success', 'Vehículo guardado');
    
        } catch (\Exception $e) {
            logger()->error('Error al guardar vehículo: '.$e->getMessage());
            return back()->with('error', 'Error al guardar: '.$e->getMessage())->withInput();
        }
    }

    public function vehiculosEliminar($id): RedirectResponse
    {
        try {
            $vehiculo = Vehiculos::findOrFail($id);
            $vehiculo->delete();

            return redirect()->route('vehiculos.get')->with('success', 'Vehículo eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el vehículo: ' . $e->getMessage());
        }
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

    public function reparacionAgregarGet(): View
    {
        $clientes = Clientes::all();
        $empleados = Empleados::all();
        
        return view('catalogos/reparacionAgregarGet', [
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reparaciones' => url('/catalogos/reparacion'),
                'Agregar Reparación' => url('/catalogos/reparacion/agregar')
            ],
            'clientes' => $clientes,
            'empleados' => $empleados
        ]);
    }

    // Procesar el formulario
// app/Http/Controllers/ReparacionController.php
public function reparacionAgregarPost(Request $request): RedirectResponse
{
    // Validación reforzada
    $validated = $request->validate([
        'id_clientes' => [
            'required',
            'integer',
            'exists:clientes,id_clientes'
        ],
        'id_empleados' => [
            'required',
            'integer',
            'exists:empleados,id_empleados'
        ],
        'fecha_reparacion' => 'required|date|before_or_equal:today',
        'estado' => 'required|in:En proceso,Completada,Cancelada'
    ]);

    // Debug: Verificar datos recibidos
    logger()->debug('Datos antes de guardar:', $validated);

    try {
        $reparacion = new Reparacion();
        $reparacion->id_clientes = (int)$validated['id_clientes'];
        $reparacion->id_empleados = (int)$validated['id_empleados'];
        $reparacion->fecha_reparacion = $validated['fecha_reparacion'];
        $reparacion->estado = $validated['estado'];
        $reparacion->save();
        

        return redirect('/catalogos/reparacion')->with([
            'success' => 'Reparación registrada!',
            'reparacion_id' => $reparacion->id_reparacion
        ]);
        
    } catch (\Exception $e) {
        logger()->error('Error al guardar: '.$e->getMessage());
        return back()
               ->withInput()
               ->with('error', 'Error al guardar: '.$e->getMessage());
    }
}

    public function reparacionEliminar($id): RedirectResponse
    {
        try {
            $reparacion = Reparacion::findOrFail($id);
            $reparacion->delete();

            return redirect()->route('reparacion.get')->with('success', 'Reparación eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la reparación: ' . $e->getMessage());
        }
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
    public function pagosAgregarGet(): View
    {
        $clientes = Clientes::all();
        
        return view('catalogos/pagosAgregarGet', [
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Pagos' => url('/catalogos/pagos'),
                'Agregar Pago' => url('/catalogos/pagos/agregar')
            ],
            'clientes' => $clientes
        ]);
    }

    // Procesar el formulario
    public function pagosAgregarPost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_cliente' => 'required|exists:clientes,id_clientes',
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0|decimal:0,2'
        ]);

        try {
            $reparacion = Reparacion::where('id_clientes', $validated['id_cliente'])->first();

            if (!$reparacion) {
                return back()->withInput()->with('error', 'No se encontró una reparación asociada al cliente seleccionado.');
            }

            Pagos::create([
                'id_reparacion' => $reparacion->id_reparacion,
                'fecha' => $validated['fecha'],
                'monto' => $validated['monto']
            ]);

            return redirect('/catalogos/pagos')->with('success', 'Pago registrado correctamente');
            
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al registrar pago: '.$e->getMessage());
        }
    }

    public function pagosEliminar($id): RedirectResponse
    {
        try {
            $pago = Pagos::findOrFail($id);
            $pago->delete();

            return redirect()->route('pagos.get')->with('success', 'Pago eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el pago: ' . $e->getMessage());
        }
    }

    public function ordenReparacionGet($id_reparacion = null)
    {
        $breadcrumbs = [
            'Inicio' => url('/'),
            'Órdenes de Reparación' => url('/catalogos/orden_reparacion/ordenReparacionGet')
        ];

        $ordenes = Orden_Reparacion::where('id_reparacion', $id_reparacion)->get();

        return view('catalogos.ordenReparacionGet', compact('breadcrumbs', 'ordenes'));
    }

    public function ordenReparacionEliminar($id)
    {
        try {
            $orden = Orden_Reparacion::findOrFail($id);
            $orden->delete();

            return redirect()->route('orden_reparacion.get')->with('success', 'Orden de reparación eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la orden de reparación: ' . $e->getMessage());
        }
    }

}
