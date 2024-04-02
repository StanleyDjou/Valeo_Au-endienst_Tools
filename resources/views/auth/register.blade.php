@extends('auth.layout')
@section('title', "Register")

@section('content')
    <form action="{{ route('register') }}" method="post" class="p-2">
        @csrf

        <div class="form-group">
            <label>Name*</label>
            <input type="text" class="input-action form-control simple name-input" value="{{old('name')}}" required name="name">
            @error('name')
            <span class="text-primary">{{$message}}</span>
            @enderror
        </div>


        <div class="form-group">
            <label>Email*</label>
            <input type="text" class="focus-ring form-control simple name-input" value="{{old('email')}}" name = "email" required>
            @error('email')
            <span class="text-primary">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Phone*</label>
            <div class="input-with-icon ">
                <input id = "phone" type="tel" class="focus-ring form-control phone-input" value="{{old('phone')}}" name="phone" required>
            </div>
            @error('phone')
            <span class="text-primary">{{$message}}</span>
            @enderror
        </div>


        <div class="form-group">
            <label>Password*</label>
            <input type="password"   class=" form-control simple "  class="mt-1 input-action form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
            <span class="text-primary">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Confirm Password*</label>
            <input type="password"  class=" form-control simple "  class = " input-action form-control @error('password') is-invalid @enderror"
                   name="password_confirmation" required
                   autocomplete="current-password">
        </div>



        <div class="mb-3 text-center">
            <button class="btn btn-primary btn-block" type="submit"> Sign Up </button>
        </div>

        <div class="text-center">Already have an account ?  <a href="{{route('login')}}" class="text-primary" > Login </a></div>
    </form>
@endsection
