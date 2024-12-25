<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

$user = Auth::user();

class PostController extends Controller
{
    
    public function index(User $user) //Recibo el usuario de la url (ej: localhos/yami)
    {
        $posts = Post::where('user_id', $user->id)->paginate(4); //traigo los posts asociados al users

        return view('dashboard',[
            'user' => $user,
            'posts' => $posts, //Esta linea le pasa la informacion que traigo $posts a la vista
        ]); 
    }


    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'titulo' => ['required', 'max:255'],
            'descripcion' => 'required',
            'imagen' => 'required',
        ]); 

        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => Auth::user()->id
        // ]);

        // // OTRA FORMA DE CREAR UN REGISTRO 
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = Auth::user()->id;

        // OTRA FORMA DE ALMACENAR UN REGISTRO YA CON LA RELACIONES DE LOS MODELOS
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => Auth::user()->id
        ]);


        return redirect()->route('posts.index', Auth::user()->username);
    }

    //show: lo usamos para ver un elemento en especifico 
    public function show(User $user, Post $post)
    {
        if($user->id != $post->user_id){
            return redirect()->route('posts.index', Auth::user()->username);
        }

        return view('posts.show',[
            'post'=>$post,
            'user'=>$user
        ]);
    }


    public function destroy(Post $post)
    {
            Gate::authorize('delete', $post); //en PostPolicy manejamos la autorizacion
            
            //eliminar imagen
            $imagen_path = public_path('uploads/'.$post->imagen);
            
            if(File::exists($imagen_path)){
                unlink($imagen_path); //codigo para eliminar la imagen
            }
            
            $post->delete(); //si recibimos true de la autorizacion Gate entonces eliminamos el post

            return redirect()->route('posts.index', Auth::user()->username);
    }

}

