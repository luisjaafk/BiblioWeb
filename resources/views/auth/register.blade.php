<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-50 to-indigo-100 min-h-screen flex items-center">
    <div class="container mx-auto max-w-md p-6">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white text-center">
                <h1 class="text-2xl font-bold">Únete a nosotros</h1>
                <p class="opacity-90 mt-1">Crea tu cuenta en minutos</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}" class="p-6">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Nombre completo</label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                           placeholder="Tu nombre">
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Correo electrónico</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                           placeholder="tu@email.com">
                </div>
                
                <div class="mb-4 relative">
                    <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Contraseña</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                           placeholder="••••••••">
                    <button type="button" onclick="togglePassword('password')"
                            class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                
                <div class="mb-6 relative">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-medium mb-2">Confirmar contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                           placeholder="••••••••">
                    <button type="button" onclick="togglePassword('password_confirmation')"
                            class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-2 px-4 rounded-lg hover:from-blue-700 hover:to-indigo-800 transition shadow-md hover:shadow-lg">
                    Registrarse
                </button>
                
                <div class="mt-4 text-center text-sm text-gray-600">
                    ¿Ya tienes una cuenta? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">Inicia sesión</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>