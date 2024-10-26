<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .progress-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px; 
            position: relative; 
        }

        .progress-step {
            flex: 1;
            text-align: center;
            border: 2px solid transparent; 
            border-radius: 10px; 
            background-color: #f9f9f9; 
            padding: 10px; 
            margin: 0 10px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            position: relative; 
        }

        .progress-step.active {
            border-color: #007bff; 
            background-color: #e7f3ff; 
        }

        .progress-step.active div {
            font-weight: bold;
            color: #007bff; 
        }

 
        .progress-line {
            position: absolute;
            top: 50%;
            left: 0;
            height: 2px;
            width: 100%;
            background-color: #e0e0e0; 
            z-index: -1; 
        }

        .progress-line-active {
            background-color: #007bff;
            width: 66%; 
            height: 2px;
            position: absolute; 
            top: 50%;
            left: 0;
            z-index: -1; 

        .btn-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px; 
        }

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

    <header class="bg-light shadow">
        <div class="container d-flex align-items-center py-3">
            <img src="{{ asset('img/LOGO3.png') }}" alt="Logo" class="logo"> <!-- Logo aquí -->
            <h1 class="text-primary">MIPYCONNECTION</h1>
        </div>
    </header>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Registro MIPYME</h1>
        

        <div class="progress-container">

            <div class="progress-line"></div>
            <div class="progress-line-active" style="width: 66%;"></div>

            <!-- PASO 1 -->
            <div class="progress-step">
                <div>PASO 1</div>
                <div>Info. MIPYME</div>
            </div>

            <!-- PASO 2 (activo) -->
            <div class="progress-step active">
                <div>PASO 2</div>
                <div>Info. Propietario</div>
            </div>

            <!-- PASO 3 -->
            <div class="progress-step">
                <div>PASO 3</div>
                <div>RUT</div>
            </div>
        </div>

        <!-- Mensajes de error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para el paso 2 -->
        <form action="{{ route('empresa.guardarPaso2') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre_propietario" class="form-label">Nombre del propietario <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nombre_propietario" name="nombre_propietario" value="{{ old('nombre_propietario') }}" required>
            </div>
        
            <div class="mb-3">
                <label for="direccion_propietario" class="form-label">Dirección del propietario <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="direccion_propietario" name="direccion_propietario" value="{{ old('direccion_propietario') }}" required>
            </div>
        
            <div class="mb-3">
                <label for="telefono_propietario" class="form-label">Teléfono del propietario <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="telefono_propietario" name="telefono_propietario" value="{{ old('telefono_propietario') }}" pattern="\d*" required title="Solo se permiten números">
            </div>
        
            <div class="btn-container">
                <button type="submit" class="btn btn-primary">Siguiente</button>
            </div>
        </form>
    </div>

    <!-- Incluyendo Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
