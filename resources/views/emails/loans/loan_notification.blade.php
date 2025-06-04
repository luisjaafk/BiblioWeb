<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Notificación de Préstamo</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: #4a4a4a;
            font-family: 'Poppins', sans-serif;
            padding: 2rem;
            margin: 0;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 2rem auto;
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.6s ease-out forwards;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        }

        .header h1 {
            color: #2c3e50;
            text-align: center;
            font-weight: 700;
            margin-bottom: 2rem;
            font-size: 2rem;
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .message p {
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
            color: #4a4a4a;
        }

        .message strong {
            color: #6a11cb;
            font-weight: 700;
        }

        .footer {
            margin-top: 3rem;
            font-size: 0.85rem;
            text-align: center;
            color: #95a5a6;
            border-top: 1px solid #ecf0f1;
            padding-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Hola {{ $user->name }},</h1>
        </div>

        <div class="message">
            <p>Has pedido prestado el libro: <strong>{{ $book->title }}</strong></p>
            <p>Autor: {{ $book->author }}</p>
            <p>Fecha del préstamo: {{ $loan->created_at->format('d/m/Y') }}</p>

            <p>Gracias por usar nuestra biblioteca.</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
