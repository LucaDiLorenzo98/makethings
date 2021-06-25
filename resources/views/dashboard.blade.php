@extends('layouts.master')

@section('content')

    @include('includes.message-block')

    <section class="row new-post">
        <div class="container px-4">
            <div class="row gx-5">
                <div class="col">
                    <header><h3>What have you created?</h3></header>
                    <form action="{{  route('post.create') }}" method="post">
                        <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
                        <button type="submit" class="btn btn-primary" style="margin-top:10px" >Create Post</button>
                        <input type="hidden" name="_token" value="{{Illuminate\Support\Facades\Session::token()}}">
                    </form>
                </div>
            <div class="col">
                <form method="POST" enctype="multipart/form-data" id="upload-image" action="{{ route('index') }}" >
                    @error('image')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" style="max-height: 250px;" width="300" height="300">
                    <div>
                        <button type="submit" style="margin-top:10px" class="btn btn-primary" id="submit">Submit</button>
                        <input type="file" style="margin-top:20px" name="image" placeholder="Choose image" id="image">
                    </div>
                </form>
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function (e) {
                        $('#image').change(function(){
                            let reader = new FileReader();
                            reader.onload = (e) => {
                                $('#preview-image-before-upload').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(this.files[0]);
                        });
                    });
                </script>
            </div>
        </div>
    </section>

    <section class="row posts" style="margin-top:10px">
        <div class="col-md-20 col-md-offset-3">
            <header><h3>What other people create...</h3></header>

            @foreach($posts as $post)

                <article class="post">
                    <p>{{ $post->body }}</p>
                    <div class="info">
                        Posted by {{ $post->user->first_name }} on {{ $post->created_at }}
                    </div>
                    <div class="interaction">
                        <a href="#" class="Like">Like</a>
                        <a href="#" class="Like">Dislike</a>

                        @if(Auth::User() == $post->user)
                            <a href="{{ route('post.edit', ['post_id' => $post->id] )}}">Edit</a>
                            <a href="{{ route('post.delete', ['post_id' => $post->id] )}}">Delete</a>
                        @endif

                    </div>
                </article>

            @endforeach

        </div>
    </section>

@endsection
