<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a nuestra plataforma</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #3390bb;
        }
        p {
            color: #585858;
        }
        .logo {
            text-align: left;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #aaaaaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="email-content">
            <h1>Bienvenido, {{ $empresa->nombre }}</h1>
            <p>Tu cuenta ha sido creada con éxito. Aquí están tus credenciales:</p>
            <p><strong>Email:</strong> {{ $empresa->email }}</p>
            <p><strong>Contraseña:</strong> {{ $contrasena }}</p>
            <p>Te recomendamos cambiar tu contraseña después de iniciar sesión.</p>
        </div>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} MIPYCONNECTION. Todos los derechos reservados.</p>
    </div>
</body>
</html>
