<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Inicio de Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #4a90e2;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            line-height: 1.6;
        }
        .content ul {
            padding-left: 20px;
        }
        .content ul li {
            margin-bottom: 10px;
        }
        .btn {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #4a90e2;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }
        .btn:hover {
            background-color: #357abd;
        }
        .footer {
            background-color: #f4f4f9;
            color: #777;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Inicio de Sesión Detectado</h2>
        </div>
        <div class="content">
            <p><strong>Hola, <?php echo htmlspecialchars($nombre_usuario); ?>,</strong></p>
            <p>Se detectó un inicio de sesión en tu cuenta desde un nuevo dispositivo.</p>
            <p>Si fuiste tú, no necesitas realizar ninguna acción. Si no reconoces esta actividad, te recomendamos cambiar tu contraseña de inmediato.</p>
            <p>Detalles del inicio de sesión:</p>
            <ul>
                <li><strong>Fecha:</strong> <?php echo htmlspecialchars($fecha_inicio_sesion); ?></li>
            </ul>
            <a href="#" class="btn">Cambiar Contraseña</a>
        </div>
        <div class="footer">
            <p>Gracias por usar nuestro sistema de Control Escolar.</p>
        </div>
    </div>
</body>
</html>
