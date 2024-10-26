<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        header {
            position: sticky;
            top: 0;
            z-index: 1030; 
        }
        .logo {
            width: 50px; 
            margin-right: 10px; 
        }
    </style>
</head>
<body>
    <header class="bg-light sticky-top shadow">
        <div class="container d-flex align-items-center py-3">
            <img src="{{ asset('img/LOGO3.png') }}" alt="Logo" class="logo"> 
            <h1 class="text-primary">MIPYCONNECTION - ADMIN</h1>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger ms-auto">Cerrar Sesión</button>
            </form>
        </div>
    </header>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Lista de MIPYMES</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre de la MIPYME</th>
                    <th>RUT (PDF)</th> 
                    <th>Estado de Registro</th>
                    <th>Fecha de Registro</th>
                    <th>Ver Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empresas as $empresa)
                    <tr>
                        <td>{{ $empresa->nombre }}</td>
                        <td>
                            @if($empresa->archivos->isNotEmpty()) 
                                @foreach($empresa->archivos as $archivo)
                                    @if($archivo->nombre_archivo) 
                                        <a href="{{ asset('storage/' . $archivo->ruta_archivo) }}" target="_blank">{{ $archivo->nombre_archivo }}</a>
                                    @endif
                                @endforeach
                            @else
                                Vacío
                            @endif
                        </td>
                        <td>{{ $empresa->estado }}</td> 
                        <td>{{ $empresa->created_at->format('Y-m-d') }}</td>
                        <td><a href="{{ route('admin.Gestion', $empresa->id) }}" class="btn btn-info">Detalles</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
