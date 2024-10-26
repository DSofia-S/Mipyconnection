<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; 
        }

        .container {
            background-color: #ffffff; 
            border-radius: 10px; 
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            margin-top: 50px; 
        }

        .header {
            background-color: #007bff; 
            color: white; 
            padding: 10px 0; 
            text-align: center; 
            border-radius: 10px 10px 0 0; 
        }

        .btn-custom {
            margin-top: 20px; 
            transition: background-color 0.3s; 
        }

        .btn-custom:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="mb-0">MIPYCONNECTION</h1>
        </div>

        <h2 class="text-center mt-4">Resultado del Registro</h2>

        @if(session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="text-center">
            <a href="{{ route('empresa.paso1') }}" class="btn btn-primary btn-custom">Volver al Registro</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
