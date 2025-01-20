@extends('layouts.app')



@section('contenido')
    
    <div class="flex items-center justify-center">
        <div class="flex flex-col">
            <h2 class="font-bold text-lg mx-6">Usuario no encontrado</h2>
            <a href="{{route('home')}}" class="text-white text-center bg-blue-700 rounded-full px-2 py-2 font-bold mt-4">Regresar</a>
        </div>
    </div>


@endsection