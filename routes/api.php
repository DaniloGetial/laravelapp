<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});










//Blogs RUTAS
Route::post('/blogs', [BlogController::class, 'store']);
Route::get('/blogs/Listar', [BlogController::class, 'Listar']);
Route::get('/blogs/Buscar', [BlogController::class, 'Buscar']);
Route::put('/blogs/Update', [BlogController::class, 'update']);
Route::post('/blogs/destroy', [BlogController::class, 'destroy']);


Route::get('/users/active/account/{token}', [LoginController::class, 'validateAccount']); 


//Usuarios RUTAS
Route ::post('/store', [UserController::class, 'store']);    
Route::get('/usuarios', [UserController::class, 'Listar']);
Route::get('/usuarios/ver', [UserController::class, 'show']);
Route::put('/usuarios/update', [UserController::class, 'update']);
Route::post('/usuarios/destroy', [UserController::class, 'destroy']);


//Login RUTAS
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);


/*Route::get('/', function () {
    return view('editar');
});*/

//Route ::get('/', [UserController::class, 'index']);

//Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');

//Route::resource('usuarios', UserController::class);
