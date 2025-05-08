@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Actualizar Vehículo</h1>
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
    <div class="col-md-12">
        <form method="POST" action="{{ route('vehiculos.update.post', $vehiculo->id_vehiculos) }}">
            @csrf
            <div class="row my-4">
                <div class="col">
                    <div class="form-group">
                        <label for="id_clientes">Cliente</label>
                        <select class="form-control" id="id_clientes" name="id_clientes" required>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_clientes }}" {{ $vehiculo->id_clientes == $cliente->id_clientes ? 'selected' : '' }}>
                                    {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" value="{{ $vehiculo->marca }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" value="{{ $vehiculo->modelo }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="anio_field">Año del Vehículo</label>
                        <input type="number" class="form-control" id="anio_field" name="anio_field"
                               min="1900" max="{{ date('Y')+2 }}" 
                               value="{{ $vehiculo->año }}" required
                               oninvalid="this.setCustomValidity('Por favor ingrese un año válido entre 1900 y {{ date('Y')+2 }}')"
                               oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="activo" {{ $vehiculo->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ $vehiculo->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="submit" class="btn btn-primary me-md-2">Actualizar</button>
                <a href="{{ route('vehiculos.get') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection