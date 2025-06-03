<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    public function index()
{
    return view('login'); 
}

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!$token = auth()->attempt($credentials)) {
        return response()->json([
            
            'message' => 'Credenciales incorrectas.'
        ], 401);
    }

    $user = auth()->user(); 

    return response()->json([
        
        'message' => 'Has iniciado sesión correctamente',
        'user' => $user,
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60
    ]);
}

    public function validateAccount($token){

    $user = User::where('remember_token', $token)->first();
    if ($user && $user->remember_token == $token) {
        $user->remember_token = null;
        $user->save();
        return redirect('/')->with('sucess', 'Account confirmed successfully.');

    }else {
        return redirect('/')->with('Error',  'ivalid token.');
    }
}

public function logout()
{

   
    try {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            
            'message' => 'Sesión cerrada correctamente.'
        ]);
    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json([
            'error' => true,
            'message' => 'No se pudo cerrar la sesión. Token inválido o ausente.'
        ], 500);
    }
}


}
