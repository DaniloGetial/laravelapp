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
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);

        $blog = Blog::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'id_user' => auth()->id(),
        ]);

        return response()->json([
            
            'message' => '¡Blog creado con éxito!',
            'blog' => $blog
        ], 201);
    }

public function Listar()
{
    $blogs = Blog::all();

    return response()->json([
        
        'blogs' => $blogs
    ]);
}

public function Buscar(Request $request)
{
    
    $id = $request->input('id');


    $blogs = Blog::find($id);

    return response()->json([
       
        'blogs' => $blogs
    ]);
}


public function destroy(Request $request)
{
    $request->validate([
        'id' => 'required|integer'
    ]);

    $blog = Blog::findOrFail($request->id);

    if ($blog->id_user !== Auth::id()) {
        return response()->json([
            
            'message' => 'No tienes permiso para eliminar este blog.'
        ], 403);
    }

    $blog->delete();

    return response()->json([
        
        'message' => '¡Blog eliminado con éxito!'
    ]);
}


public function edit($id)
{
    $blog = Blog::findOrFail($id);

    if ($blog->id_user !== Auth::id()) {
        return redirect()->route('blogs.index')->with('error', 'No tienes permiso para editar este blog.');
    }

    return view('editblog', compact('blog'));
}

public function update(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:blogs,id',
        'titulo' => 'required|string|max:255',
        'contenido' => 'required|string',
    ]);

    $blog = Blog::findOrFail($request->input('id'));

    if ($blog->id_user !== Auth::id()) {
        return response()->json([
            
            'message' => 'No tienes permiso para actualizar este blog.'
        ], 403);
    }

    $blog->update([
        'titulo' => $request->input('titulo'),
        'contenido' => $request->input('contenido'),
    ]);

    return response()->json([
       
        'message' => 'Blog actualizado correctamente.',
        'blog' => $blog
    ]);
}





}


