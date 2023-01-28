<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = [
            [
                'id' => 1,
                'title' => 'laravel',
                'description' => 'hello this is laravel post',
                'posted_by' => 'Ahmed',
                'created_at' => '2022-01-28 10:05:00',
            ],
            [
                'id' => 2,
                'title' => 'php',
                'description' => 'hello this is php post',
                'posted_by' => 'Mohamed',
                'created_at' => '2022-01-30 10:05:00',
            ],
            [
                'id' => 3,
                'title' => 'JavaScript',
                'description' => 'hello this is JavaScript post',
                'posted_by' => 'SaRa',
                'created_at' => '2023-01-28 20:20:00',
            ],
        ];
//        dd($allPosts);
        return view('posts.index',[
            'posts' => $allPosts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    // public function store()
    // {
    //     return 'insert in database';
    // }

    public function show($postId)
    {
        // dd($postId);
        $allPosts = [
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
        return view('posts.show' , ['posts' => $allPosts],['postId'=>$postId]);
    }
    public function edit($postId)
    {

        // $post =$postId;
        $allPosts = [
            [
                'id' => 1,
                'title' => 'laravel',
                'description' => 'hello this is laravel post',
                'posted_by' => 'Ahmed',
                'created_at' => '2022-01-28 10:05:00',
            ],
            [
                'id' => 2,
                'title' => 'php',
                'description' => 'hello this is php post',
                'posted_by' => 'Mohamed',
                'created_at' => '2022-01-30 10:05:00',
            ],
            [
                'id' => 3,
                'title' => 'JavaScript',
                'description' => 'hello this is JavaScript post',
                'posted_by' => 'SaRa',
                'created_at' => '2023-01-28 20:20:00',
            ],
        ];
        return view('posts.edit' ,['posts' => $allPosts],['postId'=>$postId]);
    }
    public function update()
    {
        return 'successfully updated in database';
    }
}
