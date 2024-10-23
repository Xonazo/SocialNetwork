<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use  App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    
    public function createPost (PostRequest $request)
    {
        try{
            // Obtener el usuario autenticado
            $user = $request->user();

            if ($request->user_id != $user->id) {
                return response()->json(['message' => 'Unauthorized: You can only create posts for yourself.'], 403);
            }
    
            $post = new Post();
            $post->user_id = $user->id;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->save();
            return response()->json(['message' => 'Post created', [$post]], 201);
        }catch( Exception $e){
            return response()->json(['message' => 'Post not created'], 400);
        }


    }


}
