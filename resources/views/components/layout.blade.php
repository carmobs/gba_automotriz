<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GBA Automotriz</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="/assets/style.css">
    <!-- Importar Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- importar las librerías de bootstrap -->
    <link rel="stylesheet" href={{ URL::asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }} />
    <!-- importar los archivos JavaScript de Bootstrap-->
    <script src={{ URL::asset('bootstrap-5.3.3-dist/js/bootstrap.min.js') }}></script>
    <!-- importar librerías de estilos y javascript de datatables para manipular tablas desde el
    navegador del usuario-->
    <link href={{ URL::asset('DataTables/datatables.min.css')}} rel="stylesheet"/>
    <script src={{ URL::asset('DataTables/datatables.min.js')}}></script>
    <link href={{secure_asset("assets/style.css")}} rel="stylesheet" />
</head>
<body>
    @component("components.sidebar")
    @endcomponent
    <div class="container mt-4">
        @section("content")
        @show
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

