@extends('auth.layout')
@section('title', "Forgot Password")
@section('content')
    <form action="{{route('auth.forget-password')}}" method="post" class="p-2">
        @csrf
        <div class="form-group">
            <label for="emailaddress">Email address</label>
            <input class="form-control @error('email')  @enderror" type="email" id="emailaddress" name="email" required="">
            @error('email')
            <span class="text-primary">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3 text-center">
            <button class="btn btn-primary btn-block" type="submit"> Sign In </button>
        </div>

        <div class="text-center">Back to  <a href="{{route('login')}}" class="text-primary" > Login </a></div>
    </form>
@endsection

