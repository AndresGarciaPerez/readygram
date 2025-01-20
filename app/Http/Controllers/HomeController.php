<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __invoke()
    {
        $ids = Auth::user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(10);
        return view('home', ['posts' => $posts]);
    }
    
}

