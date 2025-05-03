@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Actualizar Empleado</h1>
    </div>
</div>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-8">
        <form method="POST" action="{{ route('empleados.update.post', $empleado->id_empleados) }}">
            @csrf
            <div class="row my-4">
                <div class="col">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $empleado->nombre }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="fecha_ingreso">Fecha Ingreso</label>
                        <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="{{ $empleado->fecha_ingreso }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="1" {{ $empleado->estado == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ $empleado->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="submit" class="btn btn-primary me-md-2">Actualizar</button>
                <a href="{{ route('empleados.get') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection