<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap');

        body {
            background: linear-gradient(135deg, #100010, #2b0d20);
            color: #f0e9f5;
            font-family: 'Poppins', sans-serif;
            padding: 2rem;
        }

        h1 {
            display: inline-block;
            color: #d64c81;
            margin-bottom: 2rem;
            text-shadow: 0 0 8px #6e0e4a;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.6rem 1.4rem;
            border-radius: 50px;
            font-weight: 600;
            text-align: center;
            border: none;
            cursor: pointer;
            transition: background 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 16px rgba(170, 0, 68, 0.4);
            font-family: 'Poppins', sans-serif;
        }

        .btn-danger {
            background-color: transparent;
            color: #d64c81;
        }

        .btn-danger:hover {
            color: #fff;
            background-color: #d64c81;
        }

        .btn-primary {
            background: #6e0e4a;
            color: #fff;
            margin-top: 0;
        }

        .btn-primary:hover {
            background: #aa0044;
            box-shadow: 0 6px 20px rgba(170, 0, 68, 0.6);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(34, 12, 30, 0.85);
            box-shadow: 0 6px 30px rgba(170, 0, 68, 0.3);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 1rem 1.2rem;
            text-align: left;
        }

        th {
            background: #6e0e4a;
            color: #ffffff;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.03);
        }

        tr:hover {
            background: rgba(214, 76, 129, 0.15);
        }

        a {
            color: #81c0ff;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            color: #d64c81;
        }

        .message {
            background: #6e0e4a;
            color: #fff;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 20px rgba(214, 76, 129, 0.3);
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <h1>Usuarios Registrados</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Agregar Nuevo Post</a>
    </div>

    @if (session('success'))
        <div class="message">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Creado el</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $user->id) }}">Editar</a>
                        <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-primary">Cerrar Sesión</button>
    </form>

    <a href="/login" class="btn btn-primary">Volver al Login</a>

</body>
</html>
