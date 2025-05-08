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
use App\Models\Citas;
use App\Models\Puestos;
use App\Models\Detalle_Puesto;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => ['required', 'string', 'size:10', 'regex:/^[0-9]{10}$/']
        ], [
            'telefono.size' => 'El número de teléfono debe tener exactamente 10 dígitos',
            'telefono.regex' => 'El número de teléfono debe contener solo dígitos'
        ]);

        $clientes = new Clientes([
            'nombre' => strtoupper($validated['nombre']),
            'telefono' => $validated['telefono']
        ]);
        $clientes->save();
        return redirect('/catalogos/clientes')->with('success', 'Cliente agregado correctamente');
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

    public function clientesActualizarGet($id): View
    {
        $cliente = Clientes::findOrFail($id);
        
        return view('catalogos.clientesActualizar', [
            'cliente' => $cliente,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Clientes' => url('/catalogos/clientes'),
                'Actualizar' => url("/catalogos/clientes/actualizar/$id")
            ]
        ]);
    }

    public function clientesActualizarPost(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => ['required', 'string', 'size:10', 'regex:/^[0-9]{10}$/']
        ], [
            'telefono.size' => 'El número de teléfono debe tener exactamente 10 dígitos',
            'telefono.regex' => 'El número de teléfono debe contener solo dígitos'
        ]);

        $cliente = Clientes::findOrFail($id);
        $cliente->update([
            'nombre' => strtoupper($validated['nombre']),
            'telefono' => $validated['telefono']
        ]);

        return redirect()->route('clientes.get')->with('success', 'Cliente actualizado correctamente');
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
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'tiempo' => 'required|numeric|min:0',
            'costo' => 'required|numeric|min:0'
        ]);

        // Convertir horas a formato time (HH:mm:ss)
        $horas = floor($validated['tiempo']);
        $minutos = ($validated['tiempo'] - $horas) * 60;
        $tiempo_formateado = sprintf('%02d:%02d:00', $horas, $minutos);

        $servicios = new Servicios([
            'nombre' => strtoupper($validated['nombre']),
            'descripcion' => $validated['descripcion'],
            'tiempo' => $tiempo_formateado,
            'costo' => $validated['costo']
        ]);
        $servicios->save();

        return redirect('/catalogos/servicios')->with('success', 'Servicio agregado correctamente');
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

    public function serviciosActualizarGet($id): View
    {
        $servicio = Servicios::findOrFail($id);
        
        return view('catalogos.serviciosActualizar', [
            'servicio' => $servicio,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Servicios' => url('/catalogos/servicios'),
                'Actualizar' => url("/catalogos/servicios/actualizar/$id")
            ]
        ]);
    }

    public function serviciosActualizarPost(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'tiempo' => 'required|numeric|min:0',
            'costo' => 'required|numeric|min:0'
        ]);

        // Convertir horas a formato time (HH:mm:ss)
        $horas = floor($validated['tiempo']);
        $minutos = ($validated['tiempo'] - $horas) * 60;
        $tiempo_formateado = sprintf('%02d:%02d:00', $horas, $minutos);

        $servicio = Servicios::findOrFail($id);
        $servicio->update([
            'nombre' => strtoupper($validated['nombre']),
            'descripcion' => $validated['descripcion'],
            'tiempo' => $tiempo_formateado,
            'costo' => $validated['costo']
        ]);

        return redirect()->route('servicios.get')->with('success', 'Servicio actualizado correctamente.');
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

    public function empleadosActualizarGet($id): View
    {
        $empleado = Empleados::findOrFail($id);
        
        return view('catalogos.empleadosActualizar', [
            'empleado' => $empleado,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Empleados' => url('/catalogos/empleados'),
                'Actualizar' => url("/catalogos/empleados/actualizar/$id")
            ]
        ]);
    }

    public function empleadosActualizarPost(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|in:0,1'
        ]);

        $empleado = Empleados::findOrFail($id);
        $empleado->update([
            'nombre' => strtoupper($validated['nombre']),
            'fecha_ingreso' => $validated['fecha_ingreso'],
            'estado' => $validated['estado']
        ]);

        return redirect()->route('empleados.get')->with('success', 'Empleado actualizado correctamente.');
    }

    public function empleadoPuestosGet($id): View
    {
        $empleado = Empleados::findOrFail($id);
        
        // Obtener los puestos ordenados por fecha de inicio
        $puestos = Detalle_Puesto::where('id_empleados', $id)
            ->join('puestos', 'detalle_puesto.id_puestos', '=', 'puestos.id_puestos')
            ->select('detalle_puesto.*', 'puestos.nombre_puesto')
            ->orderBy('fecha_inicio', 'asc')
            ->get();

        // Ajustar las fechas de fin
        for ($i = 0; $i < count($puestos) - 1; $i++) {
            $fechaInicioSiguiente = \Carbon\Carbon::parse($puestos[$i + 1]->fecha_inicio);
            $puestos[$i]->fecha_fin = $fechaInicioSiguiente->copy()->subDay()->format('Y-m-d');
        }

        // El último puesto mantiene su fecha_fin original
        if (count($puestos) > 0 && !$puestos[count($puestos) - 1]->fecha_fin) {
            $puestos[count($puestos) - 1]->fecha_fin = null;
        }

        $puestosDisponibles = Puestos::all();

        return view('catalogos.empleadoPuestosGet', [
            'empleado' => $empleado,
            'puestos' => $puestos,
            'puestosDisponibles' => $puestosDisponibles,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Empleados' => url('/catalogos/empleados'),
                'Puestos' => url("/catalogos/empleados/$id/puestos")
            ]
        ]);
    }

    public function empleadoPuestosAgregarGet($id): View
    {
        $empleado = Empleados::findOrFail($id);
        $puestosDisponibles = Puestos::all();

        return view('catalogos.empleadoPuestosAgregarGet', [
            'empleado' => $empleado,
            'puestosDisponibles' => $puestosDisponibles,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Empleados' => url('/catalogos/empleados'),
                'Puestos' => url("/catalogos/empleados/$id/puestos"),
                'Agregar Puesto' => url("/catalogos/empleados/$id/puestos/agregar")
            ]
        ]);
    }

    public function empleadoPuestosAgregarPost(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'id_puestos' => 'required|exists:puestos,id_puestos', // Cambiado de 'id_puesto' a 'id_puestos'
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio'
        ]);

        Detalle_Puesto::create([
            'id_empleados' => $id,
            'id_puestos' => $validated['id_puestos'],
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin']
        ]);

        return redirect()->route('empleados.puestos.get', $id)->with('success', 'Puesto agregado correctamente.');
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

    public function vehiculosActualizarGet($id): View
    {
        $vehiculo = Vehiculos::findOrFail($id);
        $clientes = Clientes::all();
        
        return view('catalogos.vehiculosActualizar', [
            'vehiculo' => $vehiculo,
            'clientes' => $clientes,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Vehículos' => url('/catalogos/vehiculos'),
                'Actualizar' => url("/catalogos/vehiculos/actualizar/$id")
            ]
        ]);
    }

    public function vehiculosActualizarPost(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'id_clientes' => 'required|exists:clientes,id_clientes',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'anio_field' => 'required|integer|min:1900|max:'.(date('Y')+2),
            'detalles_vehiculo' => 'required|string|max:100'
        ]);

        $vehiculo = Vehiculos::findOrFail($id);
        $vehiculo->update([
            'id_clientes' => $validated['id_clientes'],
            'marca' => strtoupper($validated['marca']),
            'modelo' => strtoupper($validated['modelo']),
            'año' => $validated['anio_field'],
            'detalles_vehiculo' => $validated['detalles_vehiculo']
        ]);

        return redirect()->route('vehiculos.get')->with('success', 'Vehículo actualizado correctamente.');
    }

    public function reparacionGet(): View
    {
        $reparaciones = Reparacion::join('vehiculos', 'vehiculos.id_vehiculos', '=', 'reparacion.id_vehiculos')
            ->join('clientes', 'clientes.id_clientes', '=', 'vehiculos.id_clientes')
            ->join('empleados', 'empleados.id_empleados', '=', 'reparacion.id_empleados')
            ->select(
                'reparacion.*',
                'clientes.nombre as cliente_nombre',
                'empleados.nombre as empleado_nombre',
                'vehiculos.marca',
                'vehiculos.modelo'
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
        $vehiculos = Vehiculos::with('cliente')->get();
        
        return view('catalogos/reparacionAgregarGet', [
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reparaciones' => url('/catalogos/reparacion'),
                'Agregar Reparación' => url('/catalogos/reparacion/agregar')
            ],
            'clientes' => $clientes,
            'empleados' => $empleados,
            'vehiculos' => $vehiculos
        ]);
    }

    public function reparacionAgregarPost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_vehiculos' => 'required|exists:vehiculos,id_vehiculos',
            'id_empleados' => 'required|exists:empleados,id_empleados',
            'fecha_reparacion' => 'required|date|before_or_equal:today',
            'estado' => 'required|in:En proceso,Completada,Cancelada'
        ]);

        try {
            $reparacion = new Reparacion();
            $reparacion->id_vehiculos = $validated['id_vehiculos'];
            $reparacion->id_empleados = $validated['id_empleados'];
            $reparacion->fecha_reparacion = $validated['fecha_reparacion'];
            $reparacion->estado = $validated['estado'];
            $reparacion->save();

            return redirect('/catalogos/reparacion')->with([
                'success' => 'Reparación registrada!',
                'reparacion_id' => $reparacion->id_reparacion
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al guardar: '.$e->getMessage());
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

    public function reparacionActualizarGet($id): View
    {
        $reparacion = Reparacion::findOrFail($id);
        $vehiculos = Vehiculos::with('cliente')->get();
        $empleados = Empleados::where('estado', 1)->get(); // Solo empleados activos
        
        return view('catalogos.reparacionActualizar', [
            'reparacion' => $reparacion,
            'vehiculos' => $vehiculos,
            'empleados' => $empleados,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reparaciones' => url('/catalogos/reparacion'),
                'Actualizar' => url("/catalogos/reparacion/actualizar/$id")
            ]
        ]);
    }

    public function reparacionActualizarPost(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'id_vehiculos' => 'required|exists:vehiculos,id_vehiculos',
            'id_empleados' => 'required|exists:empleados,id_empleados',
            'fecha_reparacion' => 'required|date|before_or_equal:today',
            'estado' => 'required|in:En proceso,Completada,Cancelada'
        ], [
            'id_vehiculos.required' => 'El vehículo es requerido',
            'id_vehiculos.exists' => 'El vehículo seleccionado no existe',
            'id_empleados.required' => 'El empleado es requerido',
            'id_empleados.exists' => 'El empleado seleccionado no existe',
            'fecha_reparacion.required' => 'La fecha es requerida',
            'fecha_reparacion.date' => 'El formato de fecha no es válido',
            'fecha_reparacion.before_or_equal' => 'La fecha no puede ser futura'
        ]);

        try {
            $reparacion = Reparacion::findOrFail($id);
            
            $reparacion->id_vehiculos = $validated['id_vehiculos'];
            $reparacion->id_empleados = $validated['id_empleados'];
            $reparacion->fecha_reparacion = $validated['fecha_reparacion'];
            $reparacion->estado = $validated['estado'];
            
            $reparacion->save();

            return redirect()->route('reparacion.get')
                ->with('success', 'Reparación actualizada correctamente');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al actualizar la reparación: ' . $e->getMessage());
        }
    }

    public function pagosGet(): View
    {
        $pagos = Pagos::join('reparacion', 'reparacion.id_reparacion', '=', 'pagos.id_reparacion')
            ->join('vehiculos', 'vehiculos.id_vehiculos', '=', 'reparacion.id_vehiculos')
            ->join('clientes', 'clientes.id_clientes', '=', 'vehiculos.id_clientes')
            ->select(
                'pagos.*', 
                'reparacion.id_reparacion', 
                'clientes.nombre as cliente_nombre'
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
        $clientes = Vehiculos::join('clientes', 'clientes.id_clientes', '=', 'vehiculos.id_clientes')
            ->select(
                'vehiculos.*',
                'clientes.nombre as cliente_nombre'
            )
            ->get();
        
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
            'id_vehiculo' => 'required|exists:vehiculos,id_vehiculos',
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0|decimal:0,2'
        ]);

        try {
            $reparacion = Reparacion::where('id_vehiculos', $validated['id_vehiculo'])->first();
 
            if (!$reparacion) {
                 return back()->withInput()->with('error', 'No se encontró una reparación asociada al vehículo seleccionado.');
            }

            // Verificar si ya existe un pago para esta reparación
            if (Pagos::where('id_reparacion', $reparacion->id_reparacion)->exists()) {
                return back()->withInput()->with('error', 'Ya existe un pago registrado para esta reparación.');
            }

            DB::transaction(function() use ($validated, $reparacion) {
                // Crear el pago
                Pagos::create([
                    'id_reparacion' => $reparacion->id_reparacion,
                    'fecha' => $validated['fecha'],
                    'monto' => $validated['monto']
                ]);

                // Marcar todas las órdenes de reparación como completadas
                Orden_Reparacion::where('id_reparacion', $reparacion->id_reparacion)
                    ->update(['estado' => Orden_Reparacion::ESTADO_COMPLETADO]);

                // Actualizar el estado de la reparación a Completada
                $reparacion->update(['estado' => 'Completada']);
            });

            return redirect('/catalogos/pagos')->with('success', 'Pago registrado correctamente');
            
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al registrar pago: '.$e->getMessage());
        }
    }

    public function pagosActualizarGet($id): View
    {
        $pago = Pagos::findOrFail($id);
        $clientes = Clientes::all();
        
        // Obtener el cliente actual a través de la relación reparación
        $cliente_actual = Clientes::join('reparacion', 'clientes.id_clientes', '=', 'reparacion.id_clientes')
            ->where('reparacion.id_reparacion', $pago->id_reparacion)
            ->first();

        return view('catalogos.pagosActualizar', [
            'pago' => $pago,
            'clientes' => $clientes,
            'cliente_actual' => $cliente_actual,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Pagos' => url('/catalogos/pagos'),
                'Actualizar' => url("/catalogos/pagos/actualizar/$id")
            ]
        ]);
    }

    public function pagosActualizarPost(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0|decimal:0,2'
        ]);

        try {
            $pago = Pagos::findOrFail($id);
            
            $pago->update([
                'fecha' => $validated['fecha'],
                'monto' => $validated['monto']
            ]);

            return redirect()->route('pagos.get')->with('success', 'Pago actualizado correctamente');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al actualizar el pago: ' . $e->getMessage());
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
        if (is_null($id_reparacion)) {
            return redirect()->route('orden_reparacion.get', ['id_reparacion' => 1]);
        }

        $breadcrumbs = [
            'Inicio' => url('/'),
            'Reparaciones' => url('/catalogos/reparacion'),
            'Órdenes de Reparación' => url('/catalogos/orden_reparacion/ordenReparacionGet/' . $id_reparacion)
        ];

        // Obtener la información base de la reparación
        $infoBase = Reparacion::where('reparacion.id_reparacion', $id_reparacion)
            ->join('vehiculos', 'vehiculos.id_vehiculos', '=', 'reparacion.id_vehiculos')
            ->join('clientes', 'clientes.id_clientes', '=', 'vehiculos.id_clientes')
            ->select(
                'clientes.nombre as cliente_nombre',
                'vehiculos.id_vehiculos',
                'vehiculos.marca',
                'vehiculos.modelo',
                'vehiculos.año',
                'vehiculos.detalles_vehiculo'
            )
            ->first();

        // Verificar si la reparación ya está pagada
        $isPagada = Pagos::where('id_reparacion', $id_reparacion)->exists();

        // Si está pagada, marcar todas las órdenes como completadas
        if ($isPagada) {
            Orden_Reparacion::where('id_reparacion', $id_reparacion)
                ->update(['estado' => Orden_Reparacion::ESTADO_COMPLETADO]);
        }

        // Obtener las órdenes
        $ordenes = Orden_Reparacion::where('id_reparacion', $id_reparacion)
            ->with('servicio')
            ->get();

        return view('catalogos.ordenReparacionGet', compact('breadcrumbs', 'ordenes', 'id_reparacion', 'infoBase', 'isPagada'));
    }

    public function ordenReparacionAgregarGet($id_reparacion = null)
    {   
        if (is_null($id_reparacion)) {
            return redirect()->route('orden_reparacion.get', ['id_reparacion' => 1]);
        }

        $breadcrumbs = [
            'Inicio' => url('/'),
            'Órdenes de Reparación' => url('/catalogos/orden_reparacion/ordenReparacionGet/' . $id_reparacion),
            'Agregar Orden de Reparación' => url('/catalogos/orden_reparacion/agregar/' . $id_reparacion)
        ];

        $servicios = Servicios::all(); // Obtener todos los servicios con sus costos

        return view('catalogos.ordenReparacionAgregarGet', compact('breadcrumbs', 'id_reparacion', 'servicios'));
    }

    public function ordenReparacionEliminar($id)
    {    
        try {
            $orden = Orden_Reparacion::findOrFail($id);
            $idReparacion = $orden->id_reparacion; // Obtener el ID de la reparación antes de eliminar
            $orden->delete();

            return redirect()->route('orden_reparacion.get', ['id_reparacion' => $idReparacion])
                ->with('success', 'Orden de reparación eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la orden de reparación: ' . $e->getMessage());
        }
    }

    public function ordenReparacionAgregarPost(Request $request)
    {
        $validated = $request->validate([
            'id_reparacion' => 'required|exists:reparacion,id_reparacion',
            'id_servicios' => 'required|exists:servicios,id_servicios',
            'cantidad' => 'required|integer|min:1',
            'costo_unitario_servicio' => 'required|numeric|min:0',
            'estado' => 'required|in:1,0'
        ]);    

        try {
            $orden = Orden_Reparacion::create($validated);
    
            return redirect()->route('orden_reparacion.get', ['id_reparacion' => $validated['id_reparacion']])
                ->with('success', 'Orden de reparación agregada correctamente. Total: ' . ($orden->costo_unitario_servicio * $orden->cantidad));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al agregar la orden de reparación: ' . $e->getMessage());
        }
    }

    public function ordenReparacionActualizarGet($id): View
    {
        logger()->info('GET request received for orden_reparacion.update.get', ['id' => $id]);

        $orden = Orden_Reparacion::findOrFail($id);
        $servicios = Servicios::all();

        return view('catalogos.ordenReparacionActualizar', [
            'orden' => $orden,
            'servicios' => $servicios,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Órdenes de Reparación' => url('/catalogos/orden_reparacion/ordenReparacionGet/' . $orden->id_reparacion),
                'Actualizar' => url("/catalogos/orden_reparacion/actualizar/$id")
            ]
        ]);
    }

    public function ordenReparacionActualizarPost(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'id_servicios' => 'required|exists:servicios,id_servicios',
            'costo_unitario_servicio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:1',
            'estado' => 'required|in:1,0'
        ]);

        $orden = Orden_Reparacion::findOrFail($id);
        $orden->update($validated);

        return redirect()->route('orden_reparacion.get', ['id_reparacion' => $orden->id_reparacion])
            ->with('success', 'Orden de reparación actualizada correctamente.');
    }

    public function citasGet(): View
    {
        $citas = Citas::with('vehiculo')->get();

        return view('catalogos.citasGet', [
            'citas' => $citas,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Citas' => url('/catalogos/citas')
            ]
        ]);
    }

    public function citasAgregarGet(): View
    {
        $vehiculos = Vehiculos::all();

        return view('catalogos.citasAgregarGet', [
            'vehiculos' => $vehiculos,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Citas' => url('/catalogos/citas'),
                'Agregar' => url('/catalogos/citas/agregar')
            ]
        ]);
    }

    public function citasAgregarPost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_vehiculos' => 'required|exists:vehiculos,id_vehiculos',
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required|date_format:H:i',
            'estado' => 'required|in:Pendiente,Completada,Cancelada'
        ]);

        Citas::create($validated);

        return redirect()->route('citas.get')->with('success', 'Cita agregada correctamente.');
    }

    public function citasActualizarGet($id): View
    {
        $cita = Citas::findOrFail($id);
        $vehiculos = Vehiculos::all();

        return view('catalogos.citasActualizar', [
            'cita' => $cita,
            'vehiculos' => $vehiculos,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Citas' => url('/catalogos/citas'),
                'Actualizar' => url("/catalogos/citas/actualizar/$id")
            ]
        ]);
    }

    public function citasActualizarPost(Request $request, $id): RedirectResponse
    {
        try {
            // Validar los datos del formulario
            $validated = $request->validate([
                'id_vehiculos' => 'required|exists:vehiculos,id_vehiculos',
                'fecha_cita' => 'required|date',
                'hora_cita' => 'required|date_format:H:i',
                'estado' => 'required|in:Pendiente,Completada,Cancelada'
            ]);

            // Encontrar la cita
            $cita = Citas::findOrFail($id);
            
            // Guardar los datos originales para logging
            $oldData = $cita->toArray();

            // Actualizar la cita
            $updated = $cita->update([
                'id_vehiculos' => $validated['id_vehiculos'],
                'fecha_cita' => $validated['fecha_cita'],
                'hora_cita' => $validated['hora_cita'],
                'estado' => $validated['estado']
            ]);

            if (!$updated) {
                throw new \Exception('No se pudo actualizar la cita');
            }

            // Log de los cambios
            logger()->info('Cita actualizada exitosamente', [
                'id' => $id,
                'old_data' => $oldData,
                'new_data' => $cita->fresh()->toArray()
            ]);

            return redirect()
                ->route('citas.get')
                ->with('success', 'Cita actualizada correctamente');

        } catch (\Exception $e) {
            logger()->error('Error al actualizar cita:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Error al actualizar la cita: ' . $e->getMessage());
        }
    }

    public function citasEliminar($id): RedirectResponse
    {
        $cita = Citas::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.get')->with('success', 'Cita eliminada correctamente.');
    }

    public function actualizarGet(string $category, int $id): View
    {
        $model = $this->getModel($category);
        $record = $model::findOrFail($id);

        return view('catalogos.actualizar', [
            'category' => $category,
            'record' => $record,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                ucfirst($category) => url("/catalogos/$category"),
                'Actualizar' => url("/catalogos/$category/actualizar/$id")
            ]
        ]);
    }

    public function actualizarPost(Request $request, string $category, int $id): RedirectResponse
    {
        // Validación y actualización general
        $model = $this->getModel($category);
        $record = $model::findOrFail($id);

        $validated = $request->validate([
            'fields' => 'required|array'
        ]);

        $record->update($validated['fields']);

        return redirect("/catalogos/$category")->with('success', ucfirst($category) . ' actualizado correctamente.');
    }

    private function getModel(string $category)
    {
        $models = [
            'clientes' => Clientes::class,
            'servicios' => Servicios::class,
            'empleados' => Empleados::class,
            'vehiculos' => Vehiculos::class,
            'reparacion' => Reparacion::class,
            'pagos' => Pagos::class,
        ];

        if (!array_key_exists($category, $models)) {
            abort(404, 'Categoría no encontrada.');
        }

        return $models[$category];
    }

    public function puestosGet(): View
    {
        $puestos = Puestos::all();
        return view('catalogos.puestosGet', [
            'puestos' => $puestos,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Puestos' => url('/catalogos/puestos')
            ]
        ]);
    }

    public function puestosAgregarGet(): View
    {
        return view('catalogos.puestosAgregarGet', [
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Puestos' => url('/catalogos/puestos'),
                'Agregar' => url('/catalogos/puestos/agregar')
            ]
        ]);
    }

    public function puestosAgregarPost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre_puesto' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'sueldo' => 'required|numeric|min:0'
        ]);

        Puestos::create($validated);
        return redirect()->route('puestos.get')->with('success', 'Puesto agregado correctamente.');
    }

    public function puestosActualizarGet($id): View
    {
        $puesto = Puestos::findOrFail($id); // Verifica que el puesto exista en la base de datos.
        return view('catalogos.puestosActualizar', [
            'puesto' => $puesto,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Puestos' => url('/catalogos/puestos'),
                'Actualizar' => url("/catalogos/puestos/actualizar/$id")
            ]
        ]);
    }

    public function puestosActualizarPost(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'nombre_puesto' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'sueldo' => 'required|numeric|min:0'
        ]);

        $puesto = Puestos::findOrFail($id); // Verifica que el puesto exista en la base de datos.
        $puesto->update($validated); // Actualiza los datos del puesto.
        return redirect()->route('puestos.get')->with('success', 'Puesto actualizado correctamente.');
    }

    public function puestosEliminar($id): RedirectResponse
    {
        try {
            $puesto = Puestos::findOrFail($id);
            $puesto->delete();

            return redirect()->route('puestos.get')->with('success', 'Puesto eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el puesto: ' . $e->getMessage());
        }
    }

    public function reportesGet(): View
    {
        return view('catalogos.reportes', [
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reportes' => url('/catalogos/reportes')
            ]
        ]);
    }

    public function reporteCitas(Request $request): View
    {
        $citas = null;

        if ($request->has(['fecha_inicio', 'fecha_fin'])) {
            $validated = $request->validate([
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            ]);

            // Asegúrate de que las fechas estén en el formato correcto
            $fechaInicio = Carbon::parse($validated['fecha_inicio'])->startOfDay();
            $fechaFin = Carbon::parse($validated['fecha_fin'])->endOfDay();

            // Ajustar la consulta para incluir las horas correctamente
            $citas = Citas::join('vehiculos', 'vehiculos.id_vehiculos', '=', 'citas.id_vehiculos')
                ->select('citas.*', 'vehiculos.marca', 'vehiculos.modelo')
                ->whereBetween('fecha_cita', [$fechaInicio, $fechaFin])
                ->get();
        }

        return view('catalogos.reportesCitas', [
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reportes' => url('/catalogos/reportes'),
                'Citas' => url('/catalogos/reportes/citas')
            ],
            'citas' => $citas
        ]);
    }

    public function reportePagos(Request $request): View
    {
        $pagos = null;

        if ($request->has(['fecha_inicio', 'fecha_fin'])) {
            $validated = $request->validate([
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            ]);

            $fechaInicio = Carbon::parse($validated['fecha_inicio'])->startOfDay();
            $fechaFin = Carbon::parse($validated['fecha_fin'])->endOfDay();

            $pagos = Pagos::join('reparacion', 'reparacion.id_reparacion', '=', 'pagos.id_reparacion')
                ->join('vehiculos', 'vehiculos.id_vehiculos', '=', 'reparacion.id_vehiculos')
                ->join('clientes', 'clientes.id_clientes', '=', 'vehiculos.id_clientes')
                ->select('pagos.*', 'clientes.nombre as cliente_nombre', 'reparacion.id_reparacion')
                ->whereBetween('pagos.fecha', [$fechaInicio, $fechaFin])
                ->get();
        }

        return view('catalogos.reportesPagos', [
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reportes' => url('/catalogos/reportes'),
                'Pagos' => url('/catalogos/reportes/pagos')
            ],
            'pagos' => $pagos
        ]);
    }

    public function reporteReparaciones(Request $request): View
    {
        $reparaciones = null;

        if ($request->has('fecha')) {
            $validated = $request->validate([
                'fecha' => 'required|date',
            ]);
            $fecha = Carbon::parse($validated['fecha'])->startOfDay();

            $reparaciones = Reparacion::join('vehiculos', 'vehiculos.id_vehiculos', '=', 'reparacion.id_vehiculos')
                ->join('clientes', 'clientes.id_clientes', '=', 'vehiculos.id_clientes')
                ->join('empleados', 'empleados.id_empleados', '=', 'reparacion.id_empleados')
                ->select(
                    'reparacion.*',
                    'clientes.nombre as cliente_nombre',
                    'empleados.nombre as mecanico_nombre'
                )
                ->whereDate('reparacion.fecha_reparacion', $fecha)
                ->get();
        }

        return view('catalogos.reportesReparaciones', [
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reportes' => url('/catalogos/reportes'),
                'Reparaciones' => url('/catalogos/reportes/reparaciones')
            ],
            'reparaciones' => $reparaciones
        ]);
    }
}