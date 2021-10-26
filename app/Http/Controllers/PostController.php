<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
    public function store(Request $request) 
	{
		$post = new Post;
        $post->title = $request->title;
        $post->body  = $request->body;
        $post->user()->associate($request->user());
        $post->category_id = $request->category_id;
		$post->save();

		return new PostResource($post);
    }
    
	public function index(Request $request) 
	{
		return PostResource::collection(Post::all());
	}    

	public function show(Post $post) 
	{
		return new PostResource($post);
	}

	public function update(Request $request, Post $post) 
	{
		$post->title       = $request->title;
        $post->body        = $request->body;
        $post->category_id = $request->category_id;		
		$post->save();
		return new PostResource($post);
	}

	public function destroy(Post $post) 
	{
		$post->delete();
		return response(null, 204);
	}	
}
