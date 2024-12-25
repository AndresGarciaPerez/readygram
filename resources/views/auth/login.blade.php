@extends('layouts.app')

@section('titulo') 
 Iniciar sesion en ReadyGram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-6 md:items-center">

        <div class="md:w-6/12 mb-10 md:mb-0">
            <img src="https://res.cloudinary.com/dzmdypny0/image/upload/v1733847112/login_kkjdus.jpg" 
            alt="Login de usuario">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            {{-- Me valida mi form y request para evitar ataques, tambien me devueve un token --}}
            <form method="POST" action="{{route('login')}}" > 
                @csrf
                @if (session('mensaje'))
                <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{session('Mensaje')}}</div>
                @endif
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
                        Ingresar contraseña
                    </label>
                    <input id="password" name="password" type="password" placeholder="Crear contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-700 @enderror">
                    @if ($errors->has('password'))
                        <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{$errors->first('password')}}</div>
                    @endif
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember"> <label for="remember" class="text-gray-500 text-sm">Mantener sesion abierta</label> 
                </div>

                <input type="submit" value="Iniciar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                @if ($errors->has('name'))
                    <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{$errors->first('password_confirmation')}}</div>
                @endif
            </form>
        </div>
    </div>
@endsection