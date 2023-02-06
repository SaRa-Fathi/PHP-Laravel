@extends('layouts.app')

@section('title') index @endsection

@section('content')

<div class="row" >
    <div class="col text-start" >
        <a href="{{ route('posts.restore') }}" class=" btn btn-light colorBorder delPosts" style="text-align: center ;">Deleted Posts</a>
    </div>
    <div class="col text-end" >
        <a href="{{route('posts.create')}}" class="btn colorButton">New Post</a>
    </div>

</div><br>

    <div class="row row-cols-1 row-cols-md-3" >
        @foreach($posts as $post)
        <div class="col mb-4" >
        <div class="card colorBorder">
            <div class="card-header">
                <span>#{{$post->id}}</span>
                <p style="text-align: center"><i class="bi bi-pen"></i> {{$post->user->name ?? 'Not Found'}} posted it in  {{$post->created_at->format('20y-m-d')}}</p>
            </div>
            <img src="{{Storage::disk('local')->url($post->image) }}" class="card-img" style="height: 230px" alt="...">

            <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <h5 class="card-title text-muted">{{$post->slug}}</h5>
            </div>
            <div class="card-footer text-center">
                <span class="fa-solid fa-trash"></span>
                <a  href="{{route('posts.show', $post->id)}}" class=" bi bi-eye" title='View this Post'></a>
                <a href="{{route('posts.edit', $post->id), 'edit'}}" class="bi bi-pen p-5" style="color: green"title='Edit this Post' ></a>

                        <form id="delete-form" style="display: inline" method="POST" action="{{route('posts.destroy',$post->id)}}">
                            @csrf
                            @method('DELETE')
                            @if ($post->trashed())
                                                @method('PATCH')
                                            @else
                                                @method('DELETE')
                                            @endif
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="bi bi-trash3-fill show_confirm" style="color: red ;border:none;" data-toggle="tooltip" title='Delete this Post'></button>

                        </form>
            </div>
        </div>

        </div>
        @endforeach
    </div>


    <div>
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
                text: "If you delete this, You can restore it again at ant time .",
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

