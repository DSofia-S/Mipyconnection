<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empresa</title>
    <!-- Incluyendo Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .progress-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px; /* Espacio debajo del contenedor */
            position: relative; /* Para la línea de progreso */
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
            width: 100%; 
            height: 2px;
            position: absolute; 
            top: 50%;
            left: 0;
            z-index: -1; 
        }

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
    <!-- Encabezado fijo -->
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
            <div class="progress-line-active" style="width: 100%;"></div>

            <!-- PASO 1 -->
            <div class="progress-step">
                <div>PASO 1</div>
                <div>Info. MIPYME</div>
            </div>

            <!-- PASO 2 -->
            <div class="progress-step">
                <div>PASO 2</div>
                <div>Info. Propietario</div>
            </div>

            <!-- PASO 3 -->
            <div class="progress-step active">
                <div>PASO 3</div>
                <div>RUT</div>
            </div>
        </div>

        <form action="{{ route('empresa.guardarPaso3') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="documento" class="form-label">Cargar Documento (PDF):</label>
                <input type="file" class="form-control" id="documento" name="documento" accept=".pdf" required>
                <small class="text-muted">Tamaño máximo de archivo .PDF: 2 MB</small>
            </div>
        
            <div class="btn-container">
                <button type="submit" class="btn btn-primary">Finalizar Registro</button>
            </div>
        </form>
    </div>

    <!-- Incluyendo Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
