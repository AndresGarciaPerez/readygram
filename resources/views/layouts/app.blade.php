<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @stack('styles')
        @stack('scripts')
        
        <link rel="icon" type="image/x-icon" href="{{ asset('ready.ico') }}">
        <title>ReadyGram - @yield('titulo')</title>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles
    </head> 
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            @include('layouts.navigation')
        </header>
        <main class="container mx-auto mt-10 px-4 md:px-1">
            <h2 class="font-black text-center text-2xl mb-10 capitalize">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>
        <footer class="text-center p-5 mt-10 text-gray-500 font-bold uppercase bg-slate-200">
            Andres Garcia - Todos los derechos reservados
            {{now()->year}} 
            {{-- @php echo date('Y') @endphp --}}
        </footer>
    @livewireScripts
    </body>
</html>