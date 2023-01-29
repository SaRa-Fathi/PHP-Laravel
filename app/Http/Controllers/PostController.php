<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private static $allPosts = [
        [
            'id' => 1,
            'title' => 'laravel',
            'description' => 'hello this is laravel post',
            'posted_by' => 'Ahmed',
            'created_at' => '2022-01-28 10:05:00',
            'email' => 'ahmed@gmail.com',
        ],
        [
            'id' => 2,
            'title' => 'php',
            'description' => 'hello this is php post',
            'posted_by' => 'Mohamed',
            'created_at' => '2022-01-30 10:05:00',
            'email' => 'mohamed@gmail.com',
        ],
        [
            'id' => 3,
            'title' => 'JavaScript',
            'description' => 'hello this is JavaScript post',
            'posted_by' => 'SaRa',
            'created_at' => '2023-01-28 20:20:00',
            'email' => 'sara@gmail.com',
        ],
    ];
    private static $allposts = [];
    public function __construct(){
        self::$allPosts =[
            [
                'id' => 1,
                'title' => 'laravel',
                'description' => 'hello this is laravel post',
                'posted_by' => 'Ahmed',
                'created_at' => '2022-01-28 10:05:00',
                'email' => 'ahmed@gmail.com',
            ],
            [
                'id' => 2,
                'title' => 'php',
                'description' => 'hello this is php post',
                'posted_by' => 'Mohamed',
                'created_at' => '2022-01-30 10:05:00',
                'email' => 'mohamed@gmail.com',
            ],
            [
                'id' => 3,
                'title' => 'JavaScript',
                'description' => 'hello this is JavaScript post',
                'posted_by' => 'SaRa',
                'created_at' => '2023-01-28 20:20:00',
                'email' => 'sara@gmail.com',
            ],
        ];
    }
    public function index()
    {

//        dd($allPosts);
        return view('posts.index',[
            'posts' => self::$allPosts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        return 'insert in database';
    }

    public function show($postId)
    {
        // dd($postId);

        return view('posts.show' , ['posts' =>self::$allPosts],['postId'=>$postId]);
    }
    public function edit($postId)
    {

        // $post =$postId;

        return view('posts.edit' ,['posts' => self::$allPosts],['postId'=>$postId]);
    }
    public function update()
    {
        return 'successfully updated in database';
    }
}
