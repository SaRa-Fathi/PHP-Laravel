<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

// use App\Models\User;

class CommentController extends Controller
{
    // public function show($postId)
    // {
    //     //using  get single comment of specific id
    //     $comment = Comment::find($postId);
    // //    dd($allPosts);
    //     return view('posts.show',[
    //         'comment' =>$comment,
    //     ]);
    // }



    // public function store($id, Request $request)
    // {
    //     $comment = $request->all();

    //         $post = Post::find($id);
    //         $post->comments()->create(
    //         [
    //             'comment' => $comment['comment'],
    //             'comment' => $comment['comment'],
    //         ]
    //         );
    //         return redirect()->route('posts.show', ['post' => $id]);
    // }

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
        //store input data in database

        $data = request()->all();
        // dd($data);
        $post = Post::find($postId);
        $comment = $data['comment'];
        $userId = $data['comment_creator']; //User::id();

        $post->comments()->create([
            'comment' => $comment,
            'user_id' => $userId,
        ]);
        return to_route("posts.show" , ['post' => $postId]);
    }


    public function edit($id)
    {
        $comment = Comment::find($id);
        return view("comments.edit", ['comment' => $comment]);
    }



    // public function edit($id)
    // {

    //     // get post with given id
    //     $comment = Comment::find($id);
    //     return view("comments.edit", ['comment' => $comment]);
    // }

    // public function update($id, Request $newComment)
    // {

    //     // get request data
    //     $newComment = request()->all();
    //     $comment = Comment::find($id);

    //     // if all inputs are given
    //     if ($newComment['comment']) {

    //         // set the new value
    //         $comment->comment = $newComment['comment'];

    //         // save the comment to database
    //         $comment->save();
    //         return redirect()->route('posts.show', ['post' => $comment->commentable]);
    //     }

    //     // if some input is empty
    //     else {
    //         return redirect()->route('comments.edit', ['comment' => $comment]);
    //     }
    // }
    // public function destroy($id)
    // {
    //     // find the comment then delete it
    //     $comment = Comment::find($id);
    //     $comment->delete();
    //     return redirect()->route('posts.show', ['post' => $comment->commentable]);
    // }



}
