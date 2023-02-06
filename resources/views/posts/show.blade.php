@extends('layouts.app')

@section('title') view @endsection

@section('content')

<div class="row row-cols-9" >
    {{-- =====================To display all data of a specific post========================= --}}
    <div class="col mb-4" >
        <div class="card colorBorder">
            <div class="card-header">
                <span>#{{$post->id}}</span>
                <h5 class="card-title text-center">{{$post->title}}</h5>
            </div>
            <img src="{{Storage::disk('local')->url($post->image) }}" class="card-img" style="height: 230px" alt="...">

            <div class="card-body">
                <h5 class="card-title">Description</h5>
                <p class="card-title ">{{$post->description}}</p>
            </div>
            <div class="card-footer text-center">
                <p class="card-text"><small class="text-muted">Created @ {{ $post['created_at'] }}</small></p>
                <p class="card-text"><small class="text-muted">Updated @ {{ $post['updated_at'] }}</small></p>
            </div>
        </div>
    </div>

    <div class="card col mb-4 colorBorder">
        {{-- =====================To display all comments of a specific post========================= --}}
        <div class="card-header text-center" >
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
                <textarea name='comment'rows="2" cols="35"></textarea>
                <select class="form-control" name="comment_creator">
                    {{-- {{ dd($users) }}; --}}
                    @foreach($users as $user)
                        <option value="{{$user->id}}"> {{$user->name}} </option>
                    @endforeach
                    {{-- <option value='1'> Sara </option> --}}
                </select>
                <button type="submit" class="btn mt-1 colorButton" >Add Comment</button>
            </form>
        </div>
    </div>
</div>
{{-- style="border: 1px solid #00337C;" --}}
{{-- =====================Post Creator Info========================= --}}
<div class="card mb-3 colorBorder" style="max-width: 630px;">
    <div class="row no-gutters">
        <div class="col-md-5">
        <img src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg" class="card-img" alt="...">
        </div>
        <div class="col-md-7">
            <h5 class="card-header text-center">Post Creator Info</h5>
            <div class="card-body">
                <span class="card-title h5"> Name :</span>
                <span class="card-text "> {{ $post->user->name }}</span><br><hr>

                <span class="card-title h5">Email :</span>
                <span class="card-text">{{ $post->user->email}}</span><br><hr>

                <span class="card-title h5">Created At :</span>
                <span class="card-text">{{ $post['created_at'] }}</span>
            </div>
        </div>
    </div>
</div>


@endsection
