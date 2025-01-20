<div>
    <form wire:submit.prevent='Buscar'>
        <div class="flex h-8">
            <input type="search" name="username" wire:model='termino' id="search" class="block w-full md:28 p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Escribe el usuario" required />
            <button type="submit" class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md px-1 w-28">Buscar</button>
        </div>
    </form>   

    @if($mensaje)
        <p id="mensaje" class="text-red-600 font-bold text-xs">{{ $mensaje }}</p>
    @endif


    <script>
        window.addEventListener('limpiarMensaje', () => {
            setTimeout(() => {
                document.getElementById('mensaje')?.remove();
            }, 5000);
        });
    </script>

</div>
