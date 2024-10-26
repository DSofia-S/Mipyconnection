<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; 
        }

        .container {
            max-width: 1200px; 
            margin-top: 50px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }

        .logo-container {
            flex: 1; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }

        .form-container {
            background-color: #ffffff; /
            border-radius: 10px; /
            padding: 50px; 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); 
            flex: 1; 
            margin-left: 20px; 
        }

        .header {
            text-align: center; 
            margin-bottom: 20px; 
        }

        .btn-custom {
            width: 100%; 
            margin-top: 20px; 
        }

        img {
            max-width: 90%; 
            height: auto;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="/img/LOGO3.png" alt="Logo"> 
        </div>

        <div class="form-container">
            <div class="header">
                <h2>Iniciar Sesión</h2>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-custom">Iniciar sesión</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
