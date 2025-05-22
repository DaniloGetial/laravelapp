<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/' ,[LoginController::class, 'index']);
Route::post('/login' ,[LoginController::class, 'login'])->name('login.sesion');
Route::get('/welcome' ,[UserController::class, 'FormWelcome']);


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*Route::get('/', function () {
    return view('editar');
});*/

//Route ::get('/', [UserController::class, 'index']);
Route ::post('/store', [UserController::class, 'store']);
//Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');

Route::resource('usuarios', UserController::class);



