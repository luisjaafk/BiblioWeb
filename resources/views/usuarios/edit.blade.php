<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <style>
        body {
            background: #1a0b14;
            color: #f3e6f0;
            font-family: 'Poppins', sans-serif;
            padding: 2rem;
        }
        h1 {
            color: #d64c81;
            text-align: center;
            margin-bottom: 2rem;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            background: rgba(34,12,30,0.9);
            padding: 2rem;
            border-radius: 10px;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        input {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: none;
            border-radius: 5px;
        }
        button {
            background: #aa0044;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }
        button:hover {
            background: #d64c81;
        }
    </style>
</head>
<body>
    <h1>Editar Usuario</h1>

    <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nombre</label>
        <input type="text" name="name" value="{{ $user->name }}" required>

        <label for="email">Correo</label>
        <input type="email" name="email" value="{{ $user->email }}" required>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
