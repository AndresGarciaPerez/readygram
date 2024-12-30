<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/log',HomeController::class)->name('home')->middleware('auth'); 
  
//------------- NOTA: LEER CONVENCIONES DE URL LARAVEL ------------------//

//RUTAS PARA EL PERFIL
Route::get('/editar-perfil',[PerfilController::class, 'index'])->name('perfil.index')->middleware('auth');
Route::post('/editar-perfil',[PerfilController::class, 'store'])->name('perfil.store');



Route::get('/register', [RegisterController::class, 'index'])->name('register'); //MOSTRAR vista de register 
Route::post('/register', [RegisterController::class, 'store']); //accion: Crear un nuevo usuario (almacenar)

Route::get('/', [LoginController::class, 'index'])->name('login'); //MOSTRAR vista de login
Route::post('/login', [LoginController::class, 'store'])->name('login'); //accion: iniciar sesion 

//es mas seguro con post que con get
Route::post('/logout', [LogoutController::class, 'store'])->name('logout'); //accion: cerrar sesion

Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');//mostrar vista despues de haber iniciado sesion (muestra una lista de elementos)

Route::get('/post/create',[PostController::class, 'create'])->name('posts.create')->middleware('auth'); //muestra la vista para crear publicacion 
Route::post('/posts',[PostController::class, 'store'])->name('posts.store'); //valida y crea la publicacion en la BD
Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');//mostrar detalle de cada foto (show es para mostrar un elemento en especifico)
Route::post ('/{user:username}/posts/{post}',[ComentarioController::class,'store'])->name('comentarios.store');//Accion: guardar comentario

Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store'); //accion: guardar imagen

//LIKE A LAS FOTOS 
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.like.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.like.destroy');


//SIGUIENDO A USUARIOS 
Route::post('{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');




