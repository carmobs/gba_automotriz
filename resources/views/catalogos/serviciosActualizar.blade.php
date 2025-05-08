@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Actualizar Servicio</h1>
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
        <form method="POST" action="{{ route('servicios.update.post', $servicio->id_servicios) }}">
            @csrf
            <div class="row my-4">
                <div class="col">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $servicio->nombre }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $servicio->descripcion }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="tiempo">Tiempo (horas)</label>
                        <input type="number" min="0" step="0.5" class="form-control" id="tiempo" name="tiempo" value="{{ number_format((strtotime($servicio->tiempo) - strtotime('TODAY')) / 3600, 1) }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="costo">Costo</label>
                        <input type="number" step="0.01" class="form-control" id="costo" name="costo" value="{{ $servicio->costo }}" required>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="submit" class="btn btn-primary me-md-2">Actualizar</button>
                <a href="{{ route('servicios.get') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection