<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //El motodo que muestra la vista debe llamarse index
    public function index()
    {
        if(Auth::check()){
            //Redireccionar usuarios con sesión activa.
            return redirect()->route('post.index');
        }
        return view('auth.register');
    }

    public function store(Request $request)
    {

        // dd($request); me muestra los datos de mi formulario 
        // dd($request->get('username)); me muestra los datos de un campo especifico de mi formulario 

        //VALIDACION EN LARAVEL
        $validate = $request->validate([
            'name' => ['required', 'max:20'],
            'username' => 'required|unique:users|alpha_dash|min:3|max:30',
            'email' => 'required|unique:users|email|min:3|max:30',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request["name"],
            'username' => Str::slug($request["username"]), //convierte el texto a formato url
            'email' => $request["email"],
            'password' => Hash::make($request["password"]),  
        ]);

        //Autenticando usuario 
        Auth::attempt($request->only('email', 'password')); 


        //redireccionado 
        return redirect()->route('posts.index', Auth::user()->username);
    }
}


