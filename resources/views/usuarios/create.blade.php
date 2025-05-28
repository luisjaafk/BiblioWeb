
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registro de Usuario</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap');

        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #2c003e, #6b0044);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #f0e9f2;
        }

        .login-container {
            background: rgba(34, 12, 30, 0.85);
            padding: 3rem 4rem;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(170, 0, 68, 0.8);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            font-weight: 600;
            font-size: 2.4rem;
            margin-bottom: 1rem;
            color: #d64c81;
            text-shadow: 0 0 10px #d64c81;
        }

        form {
            margin-top: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        label {
            font-weight: 500;
            text-align: left;
            display: block;
            margin-bottom: 0.25rem;
            color: #f3e6f0cc;
            font-size: 1rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
            outline: none;
            transition: box-shadow 0.3s ease;
            background: #32102b;
            color: #f0e9f2;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            box-shadow: 0 0 8px #d64c81;
        }

        .btn-submit {
            background-color: #aa0044;
            color: #fff;
            border: none;
            padding: 0.85rem 0;
            border-radius: 50px;
            font-size: 1.15rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 6px 20px #aa004488;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #d64c81;
            box-shadow: 0 8px 30px #d64c81cc;
        }

        .message {
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .message.success {
            color: #7fffd4;
        }

        .message.error {
            color: #ff7b7b;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Registro de Usuario</h2>

        @if (session('status'))
            <div class="message success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="message error">
                <ul style="list-style-type: disc; padding-left: 1.25rem; text-align: left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Tu nombre completo" required autofocus />

            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="tucorreo@ejemplo.com" required />

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Tu contraseña" required />

            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite tu contraseña" required />

            <button type="submit" class="btn-submit">Registrar</button>
        </form>
    </div>
</body>
</html>
