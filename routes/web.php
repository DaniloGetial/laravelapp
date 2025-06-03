<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
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
Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');

Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');

Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');

Route::get('/blogs/create', [BlogController::class, 'create']);
Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');

Route::middleware(['auth', 'account'])->group(function(){
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/usuarios', [UserController::class, 'index']);
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy']);
});
Route::get('/users/active/account/{token}', [LoginController::class, 'validateAccount']); 
    


Route::get('/' ,[LoginController::class, 'index']);
Route::post('/login' ,[LoginController::class, 'login'])->name('login.sesion');
Route::get('/welcome' ,[UserController::class, 'FormWelcome']);


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*Route::get('/', function () {
    return view('editar');
});*/

//Route ::get('/', [UserController::class, 'index']);
//Route ::post('/store', [UserController::class, 'store']);
//Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');

Route::resource('usuarios', UserController::class);



