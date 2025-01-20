<nav x-data="{ open: false }" class="bg-white">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-0 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="container mx-auto flex justify-between items-center gap-5">
                <!-- Logo --> 
                <div class="shrink-0 flex items-center">
                    <a href="{{route('home')}}" class="text-md md:text-3xl font-black" >ReadyGram</a>
                </div>

                <div class="px-2">
                    <livewire:buscar-usuarios />
                </div>

                @guest
                    <nav class="hidden sm:flex gap-2" > 
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('login')}}">Login</a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('register')}}">Crear Cuenta</a>
                    </nav>
                @endguest

                @auth
                    <!-- Navigation Links -->
                    <nav class="hidden sm:flex gap-5 items-center" > 
                        <a href="{{route('posts.create')}}" 
                        class="flex items-center gap-2 bg-blue-100 border border-blue-300 px-2 py-1 text-blue-800 rounded-lg text-sm uppercase font-bold cursor-pointer">
                        <h1 class="">Crear</h1>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
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
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden ml-5 mr-1">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden mt-4">
        @auth 
        <nav class="block text-right space-y-4" > 
            <a class="block font-bold text-gray-600 text-sm" href="{{route('posts.index', auth()->user()->username)}}">
                Usuario: <span class="font-bold text-green-600 capitalize"> {{auth()->user()->username}}</span>
            </a>
            <a href="{{route('posts.create')}}" 
            class="block items-center text-blue-800 rounded-lg text-sm capitalize font-bold cursor-pointer"> 
                Crear publicacion
            </a> 
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit" class="font-bold capitalize text-gray-600 text-sm">Cerrar Sesion</button>
            </form>
        </nav>  
        @endauth

        @guest
            <nav class="flex flex-col gap-2 items-end" > 
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('login')}}">Login</a>
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('register')}}">Crear Cuenta</a>
            </nav>
        @endguest
    </div>
</nav>
