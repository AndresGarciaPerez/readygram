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
                <a href="{{route('posts.index', $post->user->username)}}" class="font-bold">{{ $post->user->username}}: </a> <span class="font-normal">{{$post->descripcion}}</span>
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
                    <div id="mensajeComentario" class="p-2 rounded-lg text-green-600 text-center uppercase font-bold">
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

                            <div class="flex items-center justify-between">
                                <div class="p-5 border-gray-300 border-b">
                                    <a href="{{route('posts.index', $comentario->user->username)}}" class="font-bold">{{$comentario->user->username}} </a><span class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</span>
                                    <p>{{$comentario->comentario}}</p>      
                                </div>

                                @auth
                                    @if (Auth::id() === $comentario->user_id)
                                        <div class="pr-5">
                                            <form action="{{route('comentario.destroy', $comentario)}}" method="POST"> @method('DELETE') @csrf
                                                <button 
                                                type="submit" 
                                                class="hover:cursor-pointer hover:bg-gray-200 p-3 rounded-full">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="#ff000d"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            </form>
                                        </div> 
                                    @endif
                                @endauth
                            </div>

                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentario aún</p>
                    @endif
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const mensajeComentario = document.getElementById('mensajeComentario');
                if (mensajeComentario) {
                    setTimeout(() => {
                        mensajeComentario.style.transition = 'opacity 0.5s ease';
                        mensajeComentario.style.opacity = '0'; // Desvanece el mensaje
                        setTimeout(() => mensajeComentario.remove(), 500); // Elimina el mensaje del DOM
                    }, 5000); // Espera 5 segundos
                }
            });
        </script>
    </div>

@endsection