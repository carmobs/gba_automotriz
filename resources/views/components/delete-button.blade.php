@props(['route', 'id'])

<form action="{{ route($route, $id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button 
        type="submit" 
        class="btn btn-danger btn-sm"
        onclick="return confirm('¿Estás seguro de eliminar este registro?')"
    >
        <i class="fas fa-trash"></i> Eliminar
    </button>
</form>