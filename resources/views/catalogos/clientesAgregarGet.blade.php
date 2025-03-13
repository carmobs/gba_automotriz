@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Agregar cliente</h1>
    </div>
    <div class="col"></div>
</div>
<form method="post" action="{{url('/catalogos/clientes/agregar')}}">
    @csrf
    <div class="row my-4">
        <div class="col">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Agregar nombre" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Agregar telefono" required>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col">
            <br>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>
@endsection