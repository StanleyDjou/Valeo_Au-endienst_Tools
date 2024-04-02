@extends('auth.layout')
@section('title', "No organization")
@section('content')
    <div>
       <h6>You belong to no organization.</h6>
       <p>Contact your administrator to add you to an organization</p>

       <div>Go back to  <a href="{{route('logout')}}" class="text-primary" > Login</a></div>
    </div>
@endsection
