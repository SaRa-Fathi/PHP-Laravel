<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// use App\Models\User;

class CommentController extends Controller
{
    public function create()
    {
        $users = User::all();
        // dd($users);

        return view('posts.show' , [
            'users' =>$users,
        ]);
    }

    public function store($postId,Request $request )
    {
        $data = request()->all();
        // dd($data);
        $post = Post::find($postId);
        $comment = $data['comment'];
        $userId = $data['comment_creator']; //User::id();

        $post->comments()->create([
            'comment' => $comment,
            'user_id' => $userId, //Auth::id(),
        ]);
        return to_route("posts.show" , ['post' => $postId]);
    }

}
