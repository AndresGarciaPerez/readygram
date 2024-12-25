<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen', 
        'user_id',
    ];


    public function user()
    {
        // (relacion inversa uno a uno) //multiples post pertenecen a un Usuario
        return $this->belongsTo(User::class)->select(['name', 'username']); //traigo solo los campos necesarios
    }
    
    //Relacion
    //tan solo con esta relacion ya tengo accedo a los comentario del post y lo puedo usar en la vista
    public function comentarios()
    {
        return $this->hasMany(Comentario::class); //(este)Un post puede tener multiples comentario
    }

    //RELACION: 
    public function likes()
    {
        return $this->hasMany(Like::class); //este post puede tener multiples likes
    }

    public function checkLike(User $user)
    {
        //revisa en la tabla likes en la columna user_id si coincide con el id del usuario autenticado que da like
        return $this->likes->contains('user_id', $user->id);
    }

}
