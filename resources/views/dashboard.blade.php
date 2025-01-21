@extends('layouts.app')
    @section('titulo') 
        {{ $user->username}}
    @endsection
 
@section('contenido')

<div class="flex justify-center px-10">
    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
        <div class="w-6/12 md:w-8/12 px-5 md:px-0">
            <img class="h-52" 
                src="{{ 
                $user->imagen ? asset('perfiles').'/'.$user->imagen 
                : 'https://th.bing.com/th/id/OIP.21inJiiFwDwSAuKlQjc8oAHaHa?rs=1&pid=ImgDetMain'}}" alt="imagen de perfil">
                @auth
                @if($user->id === Auth::user()->id) {{-- Si el usuario del url que vizualizo es igual al usuario con el que inicie sesion entonces  --}}
                <a href="{{route('perfil.index')}}" class="flex gap-1 text-blue-800 hover:text-gray-700 cursor-pointer mt-1">
                    <span>Editar </span>   <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                </a>  
                @endif
                @endauth
        </div>
        <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
            <p class="text-gray-700 text-2xl mb-5">Actividad</p>
            {{-- el user lo toma del url, asi es como funciona y muestra la informacion del usuario que esta en la url --}}
            <p class="text-gray-800 text-sm mb-3 font-bold">{{$user->followers->count()}}<span class="font-normal"> @choice('Seguidor|seguidores',$user->followers->count()) </span></p> 
            <p class="text-gray-800 text-sm mb-3 font-bold">{{$user->followings->count()}}<span class="font-normal"> Siguiendo</span></p>  
            <p class="text-gray-800 text-sm mb-3 font-bold">{{$user->posts->count()}}<span class="font-normal"> Posts</span></p> 

            @auth
                @if($user->id !== Auth::user()->id)
                    {{-- Si este user no es seguidor entonces aparece el boton de seguir --}}
                    @if(!$user->siguiendo(Auth::user()))
                        <form action="{{route('users.follow', $user)}}" method="POST"> @csrf
                            <input type="submit" value="Seguir" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                        </form>
                    @else
                        <form action="{{route('users.unfollow', $user)}}" method="POST"> @csrf @method('DELETE')
                            <input type="submit" value="Dejar de seguir" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                        </form>
                    @endif
                @endif
                
            @endauth

        </div>

    </div>
</div>   

<section class="container mx-auto mt-10">
    <h2 class="text-3xl text-center font-black my-10">Publicaciones</h2>
    <x-listar-post :posts="$posts" /> 
</section>

@endsection

