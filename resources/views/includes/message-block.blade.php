<! -- print errors messages -->
@if($errors->any())
    <div class="alert alert-danger error">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('message'))
    <div class="alert alert-danger success">
        <ul>
            {{Session::get('message')}}
        </ul>
    </div>
@endif
