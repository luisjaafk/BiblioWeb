<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Cuenta</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            overflow: hidden;
            position: relative;
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
            margin-bottom: 1.5rem;
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

        .btn-container {
            text-align: center;
            margin: 2.5rem 0;
        }

        .btn {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(106, 17, 203, 0.3);
            animation: pulse 2s infinite, float 3s ease-in-out infinite;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(106, 17, 203, 0.4);
            animation: none;
        }

        .footer {
            margin-top: 3rem;
            font-size: 0.85rem;
            text-align: center;
            color: #95a5a6;
            border-top: 1px solid #ecf0f1;
            padding-top: 1.5rem;
        }

        .footer a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #2980b9;
        }

        .illustration {
            text-align: center;
            margin: 1.5rem 0;
            opacity: 0;
            animation: fadeIn 0.6s ease-out 0.3s forwards;
        }

        .illustration svg {
            width: 120px;
            height: auto;
        }

        .highlight {
            font-weight: 600;
            color: #2c3e50;
            background: rgba(106, 17, 203, 0.1);
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>¡Hola, {{ $user->name }}! Bienvenido a {{ config('app.name') }}</h1>
        </div>

        <div class="illustration">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#6a11cb" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
        </div>

        <div class="message">
            <p>Gracias por registrarte en <span class="highlight">{{ config('app.name') }}</span>. Estamos encantados de tenerte con nosotros.</p>
            <p>Para completar tu registro y activar tu cuenta, por favor confirma tu dirección de correo electrónico haciendo clic en el siguiente botón:</p>
            
            <div class="btn-container">
<a href="{{ route('activate.account', ['token' => $token]) }}" class="btn">Confirmar mi cuenta</a>
            </div>
            
            <p>Si el botón no funciona, copia y pega este enlace en tu navegador:</p>
            <p style="word-break: break-all; font-size: 0.9rem; color: #7f8c8d;">{{ url('/users/activate/account/'.$token) }}</p>
        </div>

        <div class="footer">
            Si no solicitaste este correo, puedes ignorarlo con toda seguridad.<br>
            &copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>