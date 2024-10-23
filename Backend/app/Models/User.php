<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable // Extender Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'users';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'bio',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];


    //(un usuario puede tener muchas publicaciones)
    public function posts()
    {
        return $this->hasmany(Post::class);
    }

    //(un usuario puede tener muchos comentarios)
    public function comments()
    {
        return $this->hasmany(Comment::class);
    }

    //(un usuario puede tener muchos likes)
    public function likes()
    {
        return $this->hasmany(Like::class);
    }

    //(muchos a muchos)

    public function friends()
    {
        return $this->belongstoMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    //(un usuario puede enviar muchos mensajes)
    public function sentMessages()
    {
        return $this->hasmany(Message::class, 'sender_id');
    }

    //(un usuario puede recibir muchos mensajes)

    public function receivedMessages()
    {
        return $this->hasmany(Message::class, 'receiver_id');
    }

}
