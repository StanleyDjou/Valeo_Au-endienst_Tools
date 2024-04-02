@extends('auth.layout')
@section('title', "Admin Login")
@section('content')
    <form action="{{route('login')}}" method="post" class="p-2">
        @csrf
        <div class="form-group">
            <label for="emailaddress">Email address</label>
            <input class="form-control" type="email" id="emailaddress" name="email" required="" placeholder="john@deo.com">
            @error('email')
             <span class="text-primary">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password">
        </div>

        <div class="form-group mb-4 pb-3 d-flex justify-content-between align-items-center">
            <div class="custom-control custom-checkbox checkbox-primary">
            </div>

            <span>  <a href="{{route('auth.forget-password')}}" class="text-primary" > Forgot Password ? </a></span>
        </div>
        <div class="mb-3 text-center">
            <button class="btn btn-primary btn-block" type="submit"> Login </button>
        </div>

{{--        <div class="text-center">Don't have an Account ?  <a href="{{route('register')}}" class="text-primary" > Register </a></div>--}}
    </form>
@endsection
