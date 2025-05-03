@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Actualizar Cliente</h1>
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
    <div class="col-md-6">
        <form method="POST" action="{{ route('clientes.update.post', $cliente->id_clientes) }}" id="clienteForm">
            @csrf
            <div class="form-group mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->nombre }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="telefono">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" 
                       maxlength="10" 
                       pattern="[0-9]{10}"
                       title="El teléfono debe tener exactamente 10 dígitos"
                       oninput="validarTelefono(this)"
                       required 
                       value="{{ $cliente->telefono }}">
                <div id="telefonoError" class="invalid-feedback">
                    El número de teléfono debe tener exactamente 10 dígitos
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="submit" class="btn btn-primary me-md-2" id="submitBtn">Actualizar</button>
                <a href="{{ route('clientes.get') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
function validarTelefono(input) {
    const telefono = input.value.replace(/\D/g, ''); // Remover no-dígitos
    const submitBtn = document.getElementById('submitBtn');
    const errorDiv = document.getElementById('telefonoError');
    
    if (telefono.length !== 10) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        errorDiv.style.display = 'block';
        submitBtn.disabled = true;
    } else {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        errorDiv.style.display = 'none';
        submitBtn.disabled = false;
    }
    
    // Mantener solo los primeros 10 dígitos
    input.value = telefono.slice(0, 10);
}

document.getElementById('clienteForm').addEventListener('submit', function(e) {
    const telefono = document.getElementById('telefono').value.replace(/\D/g, '');
    if (telefono.length !== 10) {
        e.preventDefault();
        document.getElementById('telefonoError').style.display = 'block';
    }
});
</script>
@endsection