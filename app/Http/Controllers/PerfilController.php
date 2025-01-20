<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil.index');
    }
 
    public function store(Request $request)
    {

        $request->request->add(['username' => Str::slug($request->username)]); 

        $validate = $request->validate([
            'username' => ['required','unique:users,username,'.Auth::user()->id,'alpha_dash','min:3','max:30','not_in:editar-perfil']
        ]);

        if($request->imagen){
            $manager = new ImageManager(new Driver());
            $imagen = $request->file('imagen');
     
            //generar un id unico para las imagenes
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            //guardar la imagen al servidor
            $imagenServidor = $manager->read($imagen);
            //agregamos efecto a la imagen con intervention
            $imagenServidor->scale(1000, 1000);
            // la unidad de mide en PX 1= 1pixiel
     
            //agregamos la imagen a la  carpeta en public donde se guardaran las imagenes de perfil
    
            $imagenesPath = public_path('perfiles/') . '/' . $nombreImagen;
            //Una vez procesada la imagen entonces guardamos la imagen en la carpeta que creamos
            $imagenServidor->save($imagenesPath);
        }

        //Guardar cambions 

        $usuario = User::find(Auth::user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? Auth::user()->imagen ?? null;

        $usuario->save();

        //redireccionamos 
        return redirect()->route('posts.index',$usuario->username);

    }
}




// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Support\Str;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;
// use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

// class PerfilController extends Controller
// {
//     public function index()
//     {
//         return view('perfil.index');
//     }
 

//     public function store(Request $request)
//     {
//         $request->request->add(['username' => Str::slug($request->username)]); 

//         $validate = $request->validate([
//             'username' => ['required','unique:users,username,'.Auth::user()->id,'alpha_dash','min:3','max:30','not_in:editar-perfil']
//         ]);
    
//         $nombreImagen = null;
    
//         if ($request->hasFile('imagen')) {
//             $imagen = $request->file('imagen');
//             $nombreImagen = Str::uuid() . "." . $imagen->extension();
//             $response = Cloudinary::upload($imagen->getRealPath(), [
//                 'folder' => 'perfiles',
//                 'transformation' => [
//                     'width' => 1000,
//                     'height' => 1000,
//                     'crop' => 'scale'
//                     ]
//                 ]);
                
//                 // Obtén la URL pública de la imagen
//                 $nombreImagen = $response->getSecurePath();
//             }
            
//             dd($nombreImagen);
//         // Actualizar usuario
//         $usuario = User::find(Auth::user()->id);
    
//         $usuario->username = $request->username;
//         $usuario->imagen = $nombreImagen ?? Auth::user()->imagen ?? null;
//         $usuario->save();
    
//         // Redireccionamos 
//         return redirect()->route('posts.index', $usuario->username);
//     }
    
// }



 