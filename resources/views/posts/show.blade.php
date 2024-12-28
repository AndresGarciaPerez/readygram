@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection


@section('contenido')
    <div class="container mx-auto px-3 md:px-0 flex flex-wrap justify-center">
        <div class="w-full md:w-5/12">
            <img src="{{asset('uploads').'/'.$post->imagen}}" alt="imagen del post {{$post->titulo}}">
            <div class="p-3 flex items-center gap-2">

                    @auth
                    <livewire:like-post :post="$post" />

                    @endauth
                
            </div>
            <div>
                <p class="font-bold">{{ $post->user->username}}: <span class="font-normal">{{$post->descripcion}}</span></p>
                <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
            </div> 
            @auth
            @if ($post->user_id === Auth::user()->id)
            <form action="{{route('posts.destroy', $post)}}" method="POST"> @method('DELETE') @csrf
                <input type="submit" value="Eliminar publicacion" class="bg-red-600 hover:bg-red-500 text-white mt-6 p-2 rounded font-bold cursor-pointer">
            </form>  
            @endif             
            @endauth
        </div>

        <div class="w-full md:w-5/12 mt-5 md:mt-0">
            <div class="shadow bg-white p-5 mb-5 mx-0 md:mx-4">
                <p class="text-sm md:text-xl font-bold text-center text-gray-700 mb-4">Comentarios</p>
            @auth
                @if (session('mensaje'))
                    <div class="bg-green-600 p-2 rounded-lg text-white text-center uppercase font-bold">
                        {{session('mensaje')}}
                    </div>
                @endif

                <form action="{{route('comentarios.store',['post'=>$post, 'user'=>$user])}}" method="POST"> @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-sm text-gray-500 font-bold">
                           Agregar comentario 
                        </label>
                        <textarea 
                            name="comentario" 
                            id="comentario" 
                            placeholder="Escribir un comentario"
                            class="border p-3 w-full rounded-lg @error('name') border-red-700 @enderror" 
                        ></textarea>
                        @if ($errors->has('comentario'))
                            <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{$errors->first('comentario')}}</div>
                        @endif
                    </div>
                    <input 
                    type="submit" 
                    value="Comentar" 
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                    >
                </form>
            @endauth
                {{-- Esto es posible gracias a las relaciones (post con comentario y comenatario con user) --}}
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{route('posts.index', $comentario->user->username)}}" class="font-bold">{{$comentario->user->username}} </a><span class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</span>
                                <p>{{$comentario->comentario}}</p>      
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentario aún</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection