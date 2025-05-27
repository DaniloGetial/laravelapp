<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
{
    return view('login'); 
}

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('usuarios.index');
        }

        return redirect()->back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ])->withInput();
    }
    public function logout(Request $request)
    {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/'); 
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
}
