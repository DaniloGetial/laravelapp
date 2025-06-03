<?php

namespace App\Http\Controllers;

use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function FormWelcome()
    {
        return view('welcome');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function Listar()
{
    $usuarios = User::all();
    return response()->json([
        
        'usuarios' => $usuarios
    ]);
}

    

    public function login()
    {
        $usuarios = User::all();
        return view('login', compact('usuarios'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Request $request)
{
   

    $remember_token = bin2hex(random_bytes(10));

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    $user->remember_token = $remember_token;
    $user->save();

   $user->notify(new UserNotification());

    return Response()->json([
        'message' => 'Usuario creado correctamente',
        'user' => $user
    ]);
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
  
  
     public function show(Request $request)
{
    $id = $request->input('id');

    if (!$id) {
        return response()->json([
            
            'message' => 'No se ha proporcionado el ID del usuario.'
        ], 400);
    }

    $usuario = User::find($id);

    if (!$usuario) {
        return response()->json([
            
            'message' => 'Usuario no encontrado.'
        ], 404);
    }

    return response()->json([
        
        'usuario' => $usuario
    ]);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $usuario = User::findOrFail($id);
    return view('editar', compact('usuario'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function update(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'id' => 'required|integer|exists:users,id',
        'name' => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|email|unique:users,email,' . $request->id,
        'password' => 'sometimes|nullable|string|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json([
            
            'message' => 'Errores de validación.',
            'errors' => $validator->errors()
        ], 422);
    }

    $usuario = User::find($request->id);

    if (!$usuario) {
        return response()->json([
            
            'message' => 'Usuario no encontrado.'
        ], 404);
    }

    if ($request->has('name')) {
        $usuario->name = $request->name;
    }

    if ($request->has('email')) {
        $usuario->email = $request->email;
    }

    if ($request->filled('password')) {
        $usuario->password = bcrypt($request->password);
    }

    $usuario->save();

    return response()->json([
        
        'message' => 'Usuario actualizado correctamente.',
        'usuario' => $usuario
    ]);
}




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request )
    {
        //Eliminar
        $id = $request->input('id');
        $usuario = User::find($id);
        $usuario->delete();
        return response()->json([
            
            'message' => 'Usuario eliminado correctamente.'
        ]);
    }
}
