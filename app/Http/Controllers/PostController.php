<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CommentController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest; //for error shows
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{

    public function index()
    {
        //using class Post to select all from table posts
        $allPosts = Post::paginate(3);
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

    // / OR Using this
        // $title =request()->title;
        // $description = request()->description;

        // $title = $request->title;
        // $description = $request->description;
        // $request->post_creator;

    public function store(PostRequest $request )
    {

        // $request->validate([
        //     'title'=>'unique:posts',
        //     'image'=>'required',

        // ]);

        $data = request()->all();
        $title = $data['title'];
        $description = $data['description'];
        $userId = $data['post_creator'];
        $image =Storage::putFile('public' , $request->file('image')); //->image->store('public');

        Post::create([
            'title' => $title,
            'description' => $description,
            'image'=>$image,
            'user_id' => $userId,

        ]);
        return to_route("posts.index");
    }

    public function show($postId)
    {
        $post = Post::find($postId);
        $users = User::all();

        return view('posts.show' , ['post' =>$post , 'users' =>$users]);
    }

     // ->first(): limit 1 , return object   vs   ->get(): no limits ,return collect objects
        // $post =$postId;

    public function edit($postId )
    {
        // $post = Post::find($postId);
        $post = Post::where('id' , $postId)->first(); //Another Way equals the above one



        return view('posts.edit' ,['post' =>$post]);
    }

    public function update($postId ,PostRequest $request)
    {
        $post = Post::find($postId);
        $image =null;

// dd($request->all());
        $data =[
            'title' =>$request->title,
            'description' =>$request->description,
            'user_id' => $request->post_creator,
            // 'updated_at' =>$request->updated_at,
        ];
        if($request->exists('image')){
            // this return the some info about the uploaded file or image
            // return $request->image->getClientOriginalName();
            // return $request->image->getClientOriginalExtension();
            // return $request->image->getClientMimeType();
            // $imageValidate =$request->image->getClientOriginalExtension() ;
            // if($imageValidate != 'JPG' || $imageValidate !='png')
            // {
            //     return 'You Must Upload File of Type "jpg" or "png" ';
            // }

            // $image = $request->image->store('public');
            $image =Storage::putFile('public' , $request->file('image'));
            $data['image'] = $image;
            // if($post->image){
            //     Storage::delete($post->image);
            // }

            // $post->image = $image;

        }
        // else{
        //     $image =null;
        // }
        // else{
        //     return 'no';
        // }

        // dd($data);



        $post->update($data);
        // dd($post);
        return redirect()->route('posts.index' , ['post'=>$postId]);
    }

    public function destroy($postId)
    {
        Post::find($postId)->delete();
        return back();
    }

    public function restore()
    {
    $allPosts = Post::onlyTrashed()->orderBy('deleted_at' , 'desc')->get();
        return view('posts.restore', ['posts' => $allPosts,]);
    }

    public function reback($postId)
    {
    Post::whereId($postId)->restore();
    return back();
    }
}

