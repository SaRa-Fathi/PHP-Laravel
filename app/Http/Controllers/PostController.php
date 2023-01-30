<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        //using class Post to select all from table posts
        $allPosts = Post::all();
    //    dd($allPosts);
        return view('posts.index',[
            'posts' =>$allPosts,
        ]);
    }

    public function create()
    {
        $users = User::get();
        return view('posts.create' , [
            'users' =>$users,
        ]);
    }

    public function store(Request $request )
    {
        //store input data in database

        $data = request()->all();
        $title = $data['title'];
        $description = $data['description'];
        $userId = $data['post_creator'];

        // OR Using this
        // $title =request()->title;
        // $description = request()->description;

        // $title = $request->title;
        // $description = $request->description;
        // $request->post_creator;

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
        ]);
        return to_route("posts.index");
    }

    public function show($postId)
    {
        $post = Post::find($postId);

        // dd($postId);

        return view('posts.show' , ['post' =>$post]);
    }



    public function edit($postId)
    {
        // $post = Post::find($postId);
        $post = Post::where('id' , $postId)->first(); //Another Way equals the above one
        // ->first(): limit 1 , return object   vs   ->get(): no limits ,return collect objects
        // $post =$postId;

        return view('posts.edit' ,['post' =>$post]);
    }

    public function update($postId ,Request $request)
    {
        $post = Post::find($postId);
        $post->update([
            'title' =>$request->title,
            'description' =>$request->description,
            'user_id' => $request->post_creator,
            // 'updated_at' =>$request->updated_at,
        ]);
        // dd($post);
        return redirect()->route('posts.index');
    }

    public function destroy($postId)
    {
        $post = Post::find($postId);

        $post->delete();
        return redirect()->route('posts.index')->with('success','User Deleted');
    }
}

