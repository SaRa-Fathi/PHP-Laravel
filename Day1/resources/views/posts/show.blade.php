@extends('layouts.app')

@section('title') view @endsection

@section('content')
@foreach ($posts as $post)
@if($post['id'] == $postId)
<div class="card">
    <h5 class="card-header">Post Info</h5>
    <div class="card-body">
        <h5 class="card-title">Title :-</h5>
        <p class="card-text">{{ $post['title'] }}</p>
        <h5 class="card-title">Description :-</h5>
        <p class="card-text">{{ $post['description'] }}</p>
    </div>
</div>

<div class="card mt-5">
    <h5 class="card-header">Post Creator Info</h5>
    <div class="card-body">

        <span class="card-title h5"> Name :-</span>
        <span class="card-text "> {{ $post['posted_by'] }}</span><br>

        <span class="card-title h5">Email :-</span>
        <span class="card-text">{{ $post['email'] }}</span><br>

        <span class="card-title h5">Created At :-</span>
        <span class="card-text">{{ $post['created_at'] }}</span>
    </div>
</div>

<div class="text-center">
    <a href="{{route('posts.index')}}" class="mt-4 btn btn-success">Back To Posts</a>
</div>
@endif
@endforeach
@endsection
