<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-purple-200 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-lg animate-fade-in-down">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Editar Blog</h2>

        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="titulo" value="{{ old('titulo', $blog->titulo) }}" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200">
            </div>

            <div>
                <label for="contenido" class="block text-sm font-medium text-gray-700">Contenido</label>
                <textarea name="contenido" rows="5" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 transition duration-200">{{ old('contenido', $blog->contenido) }}</textarea>
            </div>

            <div class="flex justify-between mt-6">
                <button type="submit"
                    class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-2 rounded-lg shadow-md hover:scale-105 transition transform duration-300">
                    Actualizar
                </button>
                <a href="{{ route('blogs.index') }}"
                    class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition duration-200">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <style>
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.6s ease-out;
        }
    </style>

</body>
</html>
