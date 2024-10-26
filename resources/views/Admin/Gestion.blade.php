<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles MIPYME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-light sticky-top shadow">
        <div class="container py-3">
            <h1 class="text">MIPYCONNECTION - ADMIN</h1>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
            </form>
        </div>
    </header>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">DETALLES DE LA MIPYME</h1>
        <div class="mb-4">
            <p><strong>Nombre de la Empresa:</strong> {{ $empresa->nombre }}</p>
            <p><strong>Correo:</strong> {{ $empresa->email }}</p>
            <p><strong>Dirección:</strong> {{ $empresa->direccion }}</p>
            <p><strong>Teléfono:</strong> {{ $empresa->telefono }}</p>
            <p><strong>RUT:</strong> @if($empresa->archivos->isNotEmpty())
                @foreach($empresa->archivos as $archivo)
                    @if($archivo->nombre_archivo) 
                        <a href="{{ asset('storage/' . $archivo->ruta_archivo) }}" target="_blank">{{ $archivo->nombre_archivo }}</a>
                    @endif
                @endforeach
            @else
                Vacío
            @endif</p>
            <p><strong>Nombre del Propietario:</strong> {{ $empresa->nombre_propietario ?? 'No registrado' }}</p>
            <p><strong>Teléfono del Propietario:</strong> {{ $empresa->telefono_propietario ?? 'No registrado' }}</p>
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            @if($empresa->estado !== 'aprobada' && $empresa->estado !== 'rechazada')
                <form action="{{ route('empresa.aprobar', $empresa->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Aprobar</button>
                </form>
                <form action="{{ route('empresa.rechazar', $empresa->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Rechazar</button>
                </form>
            @else
                <p>Esta empresa ya ha sido {{ $empresa->estado }}.</p>
            @endif
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.Empresas') }}" class="btn btn-primary">Regresar a la lista de empresas</a>
        </div>
        
        <div id="mensaje" class="mt-4" style="display:none;">
            <div class="alert alert-success" id="mensaje-exito"></div>
            <div class="alert alert-danger" id="mensaje-error"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
