@extends('layouts.app')

@section('titulo')
    Añadir publicacion
@endsection

@push('styles')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
@endpush
 
@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">
        <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            @csrf
        </form>
    </div>
    <div class="md:w-1/2 bg-white p-10 rounded-lg shadow-xl mt-10 md:mt-0">
        <form action="{{route('posts.store')}}" method="POST"> @csrf
            <div class="mb-5">
                <label for="Titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                    Titulo
                </label>
                <input class="border p-3 w-full rounded-lg @error('name') border-red-700 @enderror" 
                id="titulo" name="titulo" 
                type="text" 
                placeholder="Titulo de la publicacion" 
                value="{{old('titulo')}}"
                >
                @if ($errors->has('titulo'))
                    <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{$errors->first('titulo')}}</div>
                @endif
            </div>
            <div class="mb-5">
                <label for="Descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                    Descripcion
                </label>
                <textarea 
                    name="descripcion" 
                    id="descripcion" 
                    placeholder="Descripcion de la publicacion"
                    class="border p-3 w-full rounded-lg @error('name') border-red-700 @enderror" 
                >{{ old('descripcion')}}</textarea>
                @if ($errors->has('descripcion'))
                    <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{$errors->first('descripcion')}}</div>
                @endif
            </div>

            <div class="mb-5">
                <input name="imagen" type="hidden" value="{{old('imagen')}}">
                @if ($errors->has('imagen'))
                <div class="text-red-700 bg-red-100 rounded-lg px-4 mt-1">{{$errors->first('imagen')}}</div>
            @endif
            </div>
            <input 
            type="submit" 
            value="Publicar" 
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    </div>

</div>
    
@endsection