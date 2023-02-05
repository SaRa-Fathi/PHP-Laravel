<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    public function index()
    {
        
        $posts = Post::all();

        //Transformation
        return PostResource::collection($posts);


        // $response = [];
        // foreach ($posts as $post)
        // {
        //     $response[] = [
        //         'id' => $post->id,
        //         'title' => $post->title,
        //         'description' => $post->description,
        //     ];
        // }
        // return $response;
    }
    public function show($postId)
    {
        $post = Post::find($postId);

        //As here we deal with only one object model
        return new PostResource($post);

        // return [
        //     'id' => $post->id,
        //     'title' => $post->title,
        //     'description' => $post->description,
        // ];
    }
    public function store(PostRequest $request){
        $data = request()->all();
        $title = $data['title'];
        $description = $data['description'];
        $userId = $data['post_creator'];
        $image =Storage::putFile('public' , $request->file('image')); //->image->store('public');

        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'image'=>$image,
            'user_id' => $userId,

        ]);
        return $post;
    }
}
