@extends('layouts.app')

@section('title') edit @endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('posts.update', ['post' => $post->id ]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">

            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value={{$post['title']}} >
        </div>
        <div class="mb-3">
            <label  class="form-label" >Description</label>
            <textarea
                class="form-control" name="description"
            >{{$post['description']}}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image" value={{$post['image']}}  >
        </div>
        <div class="mb-3">
            <label class="form-check-label">Post Creator</label>

            <select class="form-control" name="post_creator">
                    <option value="{{$post->user->id}}"> {{$post->user->name}} </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
