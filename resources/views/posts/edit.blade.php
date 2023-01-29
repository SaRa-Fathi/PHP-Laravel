@extends('layouts.app')

@section('title') edit @endsection

@section('content')
 <form method="POST" action="/posts/update">
        @csrf
        @foreach($posts as $post)
        @if ($post['id'] == $postId)
        <div class="mb-3">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" value={{$post['id']}} >

            <label class="form-label">Title</label>
            <input type="text" class="form-control" value={{$post['title']}} >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea
                class="form-control"
            >{{$post['description']}}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-check-label">Post Creator</label>

            <select class="form-control">
                <option>{{$post['posted_by']}}</option>
                {{-- <option>Nancy</option> --}}
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        @endif
        @endforeach
    </form>
@endsection
