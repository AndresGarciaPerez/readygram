@extends('layouts.app')

@section('titulo') Editar perfil: {{Auth::user()->username}} @endsection

@section('contenido')
    <div class="md:flex md:justify-center">

        <div class="md:w-1/2 bg-white shadow p-6 mx-2 md:mx-0">
            <form method="POST" action="{{route('perfil.store')}}" enctype="multipart/form-data" class="mt-10 md:mt-0"> @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre de usuario
                    </label>
                    <input class="border p-3 w-full rounded-lg @error('username') border-red-700 @enderror" 
                    id="username" name="username" 
                    type="text" 
                    placeholder="Tu Nombre" 
                    value="{{Auth::user()->username}}"
                    >
                    @if ($errors->has('username'))
                        <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{$errors->first('username')}}</div>
                    @endif
                </div>

                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen de perfil
                    </label>
                    <input class="border p-3 w-full rounded-lg" 
                    id="imagen" name="imagen" 
                    type="file" 
                    value=""
                    accept=".jpg, .png, .jpeg"
                    >
                </div>

                <input type="submit" 
                value="Guardar cambios" 
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 text-white rounded-lg"
                >
            </form>
        </div>

    </div>
@endsection