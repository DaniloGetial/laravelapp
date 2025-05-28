<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    
    <title>Mis Blogs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-10">
    
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-3xl font-bold text-blue-700 mb-6 text-center">Lista de blogs de {{ auth()->user()->name }}</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($blogs->count())
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-blue-100 text-blue-900">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Título</th>
                        <th class="border px-4 py-2">Contenido</th>
                        <th class="border px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                        <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                            <td class="border px-4 py-2">{{ $blog->id }}</td>
                            <td class="border px-4 py-2">{{ $blog->titulo }}</td>
                            <td class="border px-4 py-2">{{ Str::limit($blog->contenido, 100) }}</td>
                            <td class="border px-4 py-2 flex gap-2">
                       
                              <a href="{{ route('blogs.edit', $blog->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded transition duration-200">
                             Editar
                             </a>

                               
                                <form action="{{route('blogs.destroy',$blog->id)}}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este blog?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition duration-200">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600 text-center">Aún no has creado ningún blog.</p>
        @endif

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" style="padding: 0.5rem 1rem; background-color: #dc3545; color: white; border: none; border-radius: 5px;hover:scale-105 transition transform duration-300">
        Cerrar sesión
    </button>

      <a href="/blogs/create" style="display: inline-block; padding: 10px 20px; background-color:rgb(255, 153, 0); color: white; text-decoration: none; border: none; border-radius: 5px;">
  Crear un Blog Nuevo
</a>
   
 <a href="/usuarios" style="display: inline-block; padding: 10px 20px; background-color:rgb(255, 0, 221); color: white; text-decoration: none; border: none; border-radius: 5px;">
  Ver Usuarios
</a>
   

    </div>
  
    
</form>
</body>
</html>
