<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notificación de Rechazo</title>
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
        
        <div class="logo">
            <img src="/img/LOGO3.png" alt="Logo de la empresa" width="100">
        </div>

            <h1>Hola {{ $empresa->nombre }},</h1>
            <p>Lamentamos informarte que tu solicitud ha sido rechazada</p>
            <p>Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos.</p>
            <p>Gracias por tu interés en nuestra plataforma.</p>
        </div>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} MIPYCONNECTION. Todos los derechos reservados.</p>
    </div>
</body>
</html>
