<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    //funcion index, trae la vista 
    public function index()
    {
        if(Auth::check()){
            //Redireccionar usuarios con sesión activa.
            return redirect()->route('post.index');
        }
    
        return view('auth.login');
    }

    public function store(Request $request) //authenticate
    {

        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if(Auth::attempt($validate)){
            $request->session()->regenerate();
            //return redirect()->route('posts.index', Auth::user()->username);
            return redirect()->route('home');
            
        }

        return back()->withErrors([
            $request->remember,
            'email' => 'Credenciales incorrectas',
        ])->onlyInput('email');

    }
}
