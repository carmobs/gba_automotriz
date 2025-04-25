<nav aria-label="breadcrumb" class="custom-breadcrumb">
    <ol class="breadcrumb custom-breadcrumb-list">
        @foreach($breadcrumbs as $name => $url)
            @if($loop->last)
                <li class="breadcrumb-item active custom-breadcrumb-item" aria-current="page">
                    <span class="breadcrumb-icon">⭐</span> <span class="breadcrumb-text">{{ $name }}</span>
                </li>
            @else
                <li class="breadcrumb-item custom-breadcrumb-item">
                    <a href="{{ $url }}" class="custom-breadcrumb-link">
                        <span class="breadcrumb-icon">➡️</span> <span class="breadcrumb-text">{{ $name }}</span>
                    </a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
<style>
    .custom-breadcrumb {
        background-color: #fa3c3c; /* Color de fondo basado en la barra lateral */
        padding: 10px 15px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .custom-breadcrumb-list {
        display: flex;
        gap: 5px;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .custom-breadcrumb-item {
        font-size: 14px;
        font-weight: 500;
    }
    .custom-breadcrumb-link {
        text-decoration: none;
        color: white; /* Texto blanco para enlaces */
        transition: color 0.3s ease, transform 0.3s ease;
    }
    .custom-breadcrumb-link:hover .breadcrumb-text {
        color: #ffd700; /* Amarillo al pasar el mouse */
    }
    .custom-breadcrumb-link:hover {
        transform: scale(1.05); /* Efecto de zoom */
    }
    .breadcrumb-icon {
        margin-right: 5px;
    }
    .breadcrumb-text {
        color: white; /* Texto blanco por defecto */
        transition: color 0.3s ease;
    }
</style>
