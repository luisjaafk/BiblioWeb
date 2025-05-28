<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirma tu Cuenta</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap');

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #0a0a0a, #1c0a17);
            font-family: 'Poppins', sans-serif;
            color: #f3e6f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background-color: rgba(30, 10, 25, 0.95);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(170, 0, 85, 0.6);
            max-width: 500px;
            text-align: center;
        }

        .card h2 {
            color: #d64c81;
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        .card p {
            font-size: 1rem;
            line-height: 1.6;
            color: #f8dfff;
            margin-bottom: 1.5rem;
        }

        .highlight {
            color: #aa00aa;
            font-weight: bold;
        }

        .footer {
            margin-top: 2rem;
            font-size: 0.85rem;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>¡Gracias por registrarte!</h2>
        <p>Te hemos enviado un enlace a tu <span class="highlight">correo electrónico</span> para activar tu cuenta.</p>
        <p>Por favor, revisa tu bandeja de entrada y haz clic en el enlace para continuar.</p>
        <div class="footer">
            © {{ date('Y') }} TuAplicación. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
