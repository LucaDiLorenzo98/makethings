@extends('layouts.master')

@section('title')
    Welcome to makeThings!
@endsection

@section('content')

    @include('includes.message-block')

    <! -- SIGNUP FORM -->
    <div class="row">
        <div class="col-md-6">
            <h3>Sign Up</h3>
            <form method="POST" action="{{route('signup')}}">
                <div class="form-group">
                    <label for="email">Your E-Mail</label>
                    <! -- Request::old remember data if occur an error -->
                    <input class="form-control" type="text" name="email" id="email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="first_name">Your First Name</label>
                    <input class="form-control" type="text" name="first_name" id="first_name">
                </div>
                <div class="form-group">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
                <! -- important to include Session::token() -->
                <input type="hidden" name="_token" value="{{Illuminate\Support\Facades\Session::token()}}">
            </form>
        </div>

        <! -- SIGNIN FORM -->
        <div class="col-md-6">
            <h3>Sign In</h3>
            <form method="POST" action="{{route('signin')}}">
                <div class="form-group">
                    <label for="email">Your E-Mail</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="{{old('password')}}">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
                <! -- important to include Session::token() -->
                <input type="hidden" name="_token" value="{{Illuminate\Support\Facades\Session::token()}}">
            </form>
        </div>
    </div>
@endsection

