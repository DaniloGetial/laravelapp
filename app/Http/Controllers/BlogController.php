<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Blog;


class BlogController extends Controller
{
    public function index()
{
    $blogs = Blog::where('id_user', Auth::id())->get();

    return view('blogs', compact('blogs'));
}


  public function create()
{
    return view('crearblog'); 
}
    
public function store(Request $request)
{
    // Validar los datos
    $request->validate([
        'titulo' => 'required|string|max:255',
        'contenido' => 'required|string',
    ]);

    // Crear el blog con el ID del usuario autenticado
    Blog::create([
        'titulo' => $request->titulo,
        'contenido' => $request->contenido,
        'id_user' => Auth::id(),  // Aquí va el ID del usuario logueado
    ]);
    

    // Redirigir con mensaje
    return redirect()->route('blogs.index')->with('success', '¡Blog creado con éxito!');
}

    public function destroy($id)
{
    $blog = Blog::findOrFail($id);

    
    // Verificar si el usuario autenticado es el propietario del blog
    if ($blog->id_user !== Auth::id()) {
        return redirect()->route('blogs.index')->with('error', 'No tienes permiso para eliminar este blog.');
    }
     $blog->delete();
    return redirect()->route('blogs.index')->with('success', '¡Blog eliminado con éxito!');
}

public function edit($id)
{
    $blog = Blog::findOrFail($id);

    if ($blog->id_user !== Auth::id()) {
        return redirect()->route('blogs.index')->with('error', 'No tienes permiso para editar este blog.');
    }

    return view('editblog', compact('blog'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'contenido' => 'required|string',
    ]);

    $blog = Blog::findOrFail($id);

    if ($blog->id_user !== Auth::id()) {
        return redirect()->route('blogs.index')->with('error', 'No tienes permiso para actualizar este blog.');
    }

    $blog->update([
        'titulo' => $request->input('titulo'),
        'contenido' => $request->input('contenido'),
    ]);

    return redirect()->route('blogs.index')->with('success', 'Blog actualizado correctamente.');
}




}


