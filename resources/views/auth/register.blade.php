@extends('layouts.app')

@section('titulo') 
 Registrate en ReadyGram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-20 md:items-center">

        <div class="md:w-6/12 mb-10 md:mb-0">
            <img src="https://res.cloudinary.com/dzmdypny0/image/upload/v1737391337/ready_mb2fa9.jpg" 
            alt="Registro de usuario"
            class="rounded-lg">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            {{-- Me valida mi form y request para evitar ataques, tambien me devueve un token --}}
            <form action="{{route('register')}}" method="POST"> @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input class="border p-3 w-full rounded-lg @error('name') border-red-700 @enderror" 
                    id="name" name="name" 
                    type="text" 
                    placeholder="Tu Nombre" 
                    value="{{old('name')}}"
                    >
                    @if ($errors->has('name'))
                        <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{$errors->first('name')}}</div>
                    @endif
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre de usuario
                    </label>
                    <input id="username" name="username" type="text" placeholder="Tu Nombre de usuario" class="border p-3 w-full rounded-lg @error('username') border-red-700 @enderror" value="{{old('username')}}">
                    @if ($errors->has('username'))
                        <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{$errors->first('username')}}</div>
                    @endif
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Correo Electronico
                    </label>
                    <input id="email" name="email" type="text" placeholder="Tu Nombre Correo Electronico" class="border p-3 w-full rounded-lg @error('email') border-red-700 @enderror" value="{{old('email')}}">
                    @if ($errors->has('email'))
                        <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{$errors->first('email')}}</div>
                    @endif
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Crear contraseña
                    </label>
                    <input id="password" name="password" type="password" placeholder="Crear contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-700 @enderror">
                    @if ($errors->has('password'))
                        <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{$errors->first('password')}}</div>
                    @endif
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Confirmar contraseña
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirmar contraseña" class="border p-3 w-full rounded-lg">
                </div>
                <input type="submit" value="Crear cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                @if ($errors->has('name'))
                    <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{$errors->first('password_confirmation')}}</div>
                @endif
            </form>
        </div>
    </div>
@endsection