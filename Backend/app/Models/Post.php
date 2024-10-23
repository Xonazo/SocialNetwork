<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'media_url',
    ];

        //(muchos a uno)
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    //(una publicacion puede tener muchos comentarios)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //una publicacion puede tener muchos likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
