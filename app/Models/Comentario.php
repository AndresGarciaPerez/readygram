<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Anteriormente (en el modelo) relacionamos post con comentario
//Ahora aqui relacionamod comentario con User
class Comentario extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'comentario',
    ];

    //relacion
    public function user()
    {
        //Multiples comentario pertenecen a un usuario
        return $this->belongsTo(User::class);
    }
}
