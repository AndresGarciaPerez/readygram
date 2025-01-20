<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        //VALIDAR
        $validate = $request->validate([
            'comentario' => ['required', 'max:255'],
        ]);

        //ALMACENAR: 
        //Importante el user de la url no me sirve por que es el user del post que estoy visitando y yo necesito el user con el cual inicie sesion
        Comentario::create([
            'user_id'=>Auth::user()->id, //aqui traigo el user con el cual me autentique
            'post_id'=> $post->id, //post que viene de la url (este si me sirve)
            'comentario'=>$request->comentario,//comentatio viene del $request
        ]);

        //CONFIRMAR QUE SE GUARDO EL COMENTARIO
        return back()->with('mensaje', 'Comentario realizado correctamente');


    }

    public function destroy(Comentario $comentario)
    {
        Gate::authorize('delete', $comentario);
        $comentario->delete();
        return back(); 
    }
}
