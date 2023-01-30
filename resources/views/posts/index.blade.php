@extends('layouts.app')

@section('title') index @endsection

@section('content')
{{-- <div class="card-header">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->get('danger'))
        <div class="alert alert-danger">
            {{ session()->get('danger') }}
        </div>
    @endif
</div> --}}
    <div class="text-center">
        <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
        <a href="{{ route('posts.restore') }}" class="mt-4 btn btn-success">Go To Deleted Posts</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                {{-- <td>{{$post['id']}}</td>
                <td>{{$post['title']}}</td>
                <td>{{$post['posted_by']}}</td>
                <td>{{$post['created_at']}}</td> --}}

                {{-- Another Way --}}
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->user->name ?? 'Not Found'}}</td>
                <td>{{$post->created_at->format('20y-m-d')}}</td>

                <td>
{{--                    href="/posts/{{$post['id']}}"--}}
                    <a href="{{route('posts.show', $post->id)}}" class="btn btn-info">View</a>
                    <a href="{{route('posts.edit', $post->id), 'edit'}}" class="btn btn-primary">Edit</a>

                    <form id="delete-form" style="display: inline" method="POST" action="{{route('posts.destroy',$post->id)}}">
                        @csrf
                        @method('DELETE')
                        @if ($post->trashed())
                                            @method('PATCH')
                                        @else
                                            @method('DELETE')
                                        @endif
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>

                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
     <div style="text-align: center">
        {{ $posts->links() }}
    </div>
    @endsection



    @section('scriptHead') <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  @endsection
    @section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("id");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                form.submit();
                }
            });
    });

    </script>
    @endsection




