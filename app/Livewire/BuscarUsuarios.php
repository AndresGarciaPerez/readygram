<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class BuscarUsuarios extends Component
{
    public $termino;
    public $mensaje;

    public function render()
    {
        $usuarios = User::all();
        return view('livewire.buscar-usuarios', [
            'usuario' => $usuarios
        ]);
    }

    public function Buscar()
    {
        if($this->termino){
            $usuario = User::where('username', 'like', '%' . $this->termino . '%')->first();
 
            if($usuario){
                return redirect(route('posts.index', $usuario));
            }
            else{
              $this->mensaje = 'Usuario no encontrado';
              $this->dispatch('limpiarMensaje');
            }
        }
    }
}
