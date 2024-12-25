<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @stack('styles')
        @stack('scripts')
        
        <title>ReadyGram - @yield('titulo')</title>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center gap-5">
                <a href="{{route('home')}}" class="text-md md:text-3xl font-black" >ReadyGram</a>

                {{-- Me muestra este contenido si el usuario esta autenticado, por eso usa  @auth --}}
                @auth 
                <nav class="flex gap-5 items-center" > 
                    <a href="{{route('posts.create')}}" 
                    class="flex items-center gap-2 bg-blue-100 border border-blue-300 px-2 py-1 text-gray-600 rounded-lg text-sm uppercase font-bold cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Crear
                    </a>
                    <a class="font-bold text-gray-600 text-sm" href="{{route('posts.index', auth()->user()->username)}}">
                        Usuario: <span class="font-bold text-green-600 capitalize"> {{auth()->user()->username}}</span>
                    </a>
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button type="submit" class="font-bold uppercase bg-red-50 text-gray-600 text-sm border px-2 py-1 rounded-lg border-red-600">Cerrar Sesion</button>
                    </form>
                </nav>  
                @endauth

                {{-- Si no esta autenticado me muestra lo de @guest --}}
                @guest
                    <nav class="flex gap-2" > 
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('login')}}">Login</a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('register')}}">Crear Cuenta</a>
                    </nav>
                @endguest

            </div>
        </header>
        <main class="container mx-auto mt-10">
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