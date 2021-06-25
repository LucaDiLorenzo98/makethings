@extends('layouts.master')

@section('content')

    @include('includes.message-block')
    <section class="row new-post">
        <div class="container px-4">
            <div class="row gx-5">
                <div class="col">
                    <header><h3>Edit Post</h3></header>
                    <form action="{{ route('post.update', ['post_id' => $post->id]) }}" method="POST">
                        <textarea class="form-control" name="body" id="edit-post" rows="5" placeholder="Post to edit">{{ $post->body }}</textarea>
                        <button type="submit" class="btn btn-primary" style="margin-top:10px" >Edit Post</button>
                        <input type="hidden" name="_token" value="{{Illuminate\Support\Facades\Session::token()}}">
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
