<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Usuarios</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1a0b14, #3e1427);
            color: #f3e6f0;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .container {
            background-color: rgba(34, 12, 30, 0.85);
            padding: 3rem 4rem;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(170, 0, 68, 0.6);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-weight: 600;
            font-size: 2.8rem;
            color: #d64c81;
            margin-bottom: 0.6rem;
            text-shadow: 0 0 8px #d64c81;
        }

        p {
            font-weight: 400;
            font-size: 1.2rem;
            color: #f3e6f0cc;
            margin-bottom: 2rem;
        }

        .btn-primary {
            background-color: #aa0044;
            color: #fff;
            border: none;
            padding: 0.75rem 2.5rem;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 14px #aa0044aa;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background-color: #d64c81;
            box-shadow: 0 6px 20px #d64c81cc;
        }

        footer {
            margin-top: 3rem;
            font-size: 0.9rem;
            color: #f3e6f0aa;
            letter-spacing: 0.05em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hola, Usuarios :D</h1>
        <p>Bienvenidos a la sección de usuarios. Aquí puedes gestionar, crear y administrar los usuarios de tu aplicación.</p>
        <a href="/" class="btn-primary">Crear Nuevo Usuario</a>

        <footer>
            &copy; 2025 Tu Aplicación Laravel - Todos los derechos reservados
        </footer>
    </div>
</body>
</html>
