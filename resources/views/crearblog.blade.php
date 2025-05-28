<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-tr from-blue-50 via-white to-blue-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-xl animate-fade-in-up">
        <h2 class="text-3xl font-extrabold text-blue-700 text-center mb-8">Crear Nuevo Blog</h2>
        <form method="POST" action="/blogs/store">
            
            @csrf

            <div class="mb-6">
                <label for="titulo" class="block text-gray-700 font-semibold mb-2">Título</label>
                <input type="text" id="titulo" name="titulo" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div class="mb-8">
                <label for="contenido" class="block text-gray-700 font-semibold mb-2">Descripción</label>
                <textarea id="contenido" name="contenido" rows="5" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300"></textarea>
            </div>

            <div class="flex justify-between">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition duration-300 shadow-md">
                    Crear

                </button>
                <a href="{{ url()->previous() }}"
                   class="bg-gray-300 text-gray-800 px-6 py-2 rounded-xl hover:bg-gray-400 transition duration-300 shadow-md">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</body>
</html>
