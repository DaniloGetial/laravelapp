<body>
    <h1>Bienvenido, {{ auth()->user()->name }}</h1>
    <h1>Has iniciado sesion correctamente</h1>
    <h1>Lista de Usuarios</h1>
    

    
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>
                    <a href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>


                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>

                 
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


    <a href="/welcome" style="display: inline-block; padding: 10px 20px; background-color: #007BFF; color: white; text-decoration: none; border: none; border-radius: 5px;">
  Crear un Usuario Nuevo
</a>


<form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" style="padding: 0.5rem 1rem; background-color: #dc3545; color: white; border: none; border-radius: 5px;">
        Cerrar sesión
    </button>
</form>
    
  <a href="/blogs/create" style="display: inline-block; padding: 10px 20px; background-color:rgb(255, 153, 0); color: white; text-decoration: none; border: none; border-radius: 5px;">
  Crear un Blog Nuevo
</a>
   
 <a href="/blogs" style="display: inline-block; padding: 10px 20px; background-color:rgb(255, 0, 221); color: white; text-decoration: none; border: none; border-radius: 5px;">
  Ver mis Blogs
</a>
   
</body>
