<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //Creado relacion de usuarios a posts
    public function posts()
    {
        //relacionamos este usuario a los posts( uno a muchos)
        return $this->hasMany(Post::class);         //internamente laravel busca el user_id en las migraciones
    }

    public function likes()
    {
        return $this->hasMany(Like::class); //este usuario puede dar multiples likes
    }

    //Seguidores que tiene este usuario 
    public function followers()
    {
        //como no seguimos las convenciones de laravel 
        // entonces tenemos que especificar la tabla, y los campos foraneos que terminan en id
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }
        //muchos usuario tiene un user, belongsToMany es como el inverso de hasMany

    
    //Personas a las que sigue este usuario
    public function followings()
    {
        //como no seguimos las convenciones de laravel 
        // entonces tenemos que especificar la tabla, y los campos foraneos que terminan en id
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
        //muchos usuario tiene un user, belongsToMany es como el inverso de hasMany
    

    //COMPROBAR SI UN USUARIO SIGUE A OTRO
    public function siguiendo(User $user)
    {
        //Este usuario de follower, tiene en sus registros al usuario autenticado ? true o false
        return $this->followers->contains($user->id);
    }
}
