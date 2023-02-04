@extends('layouts.app')

@section('title') view @endsection

@section('content')

<div class="row row-cols-9" >
    {{-- =====================To display all data of a specific post========================= --}}
    <div class="col mb-4" >
        <div class="card" style="border: 1px solid blue">
            <div class="card-header">
                <span>#{{$post->id}}</span>
                <h5 class="card-title text-center">{{$post->title}}</h5>
            </div>
            <img src="{{Storage::disk('local')->url($post->image) }}" class="card-img" style="height: 230px" alt="...">

            <div class="card-body">
                <h5 class="card-title">Description</h5>
                <p class="card-title text-muted">{{$post->description}}</p>
            </div>
            <div class="card-footer text-center">
                <p class="card-text"><small class="text-muted">Created @ {{ $post['created_at'] }}</small></p>
                <p class="card-text"><small class="text-muted">Updated @ {{ $post['updated_at'] }}</small></p>
            </div>
        </div>
    </div>

    <div style="border: 1px solid blue">
        {{-- =====================To display all comments of a specific post========================= --}}
        <div class="card-header text-center">
            <h5 >{{ $post->title }} Post Comments</h5>
        </div>
        <div class="card-body">
            {{-- {{ dd($post->comments) }} --}}
            @foreach($post->comments as $comment)
                <span class="card-title h5">{{$comment->user->name}} Commented</span><br>
                <span class="card-text "> {{ $comment->comment }}</span><br>
                <hr>
            @endforeach
        </div>
        {{-- =====================To Make a comment========================= --}}
        <div class="card-footer text-center" >
            <form method="POST" action="{{ route('comments.store', $post->id ) }}">
                @csrf
                <textarea name='comment'></textarea>
                <select class="form-control" name="comment_creator">
                    {{-- {{ dd($users) }}; --}}
                    @foreach($users as $user)
                        <option value="{{$user->id}}"> {{$user->name}} </option>
                    @endforeach
                    {{-- <option value='1'> Sara </option> --}}
                </select>
                <button type="submit" class="btn btn-primary ">Add Comment</button>
            </form>
        </div>
    </div>
</div>

{{-- =====================Post Creator Info========================= --}}

<div class="card mt-5" style="border: 1px solid blue">
    <h5 class="card-header text-center">Post Creator Info</h5>
    <div class="card-body">

        <span class="card-title h5"> Name :-</span>
        <span class="card-text "> {{ $post->user->name }}</span><br>

        <span class="card-title h5">Email :-</span>
        <span class="card-text">{{ $post->user->email}}</span><br>

        <span class="card-title h5">Created At :-</span>
        <span class="card-text">{{ $post['created_at'] }}</span>
    </div>
</div>

@endsection
