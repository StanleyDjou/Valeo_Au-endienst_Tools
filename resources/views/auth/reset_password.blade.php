@extends('auth.layout')
@section('title','Reset Password')
@section('content')
    <form  action="{{ route('password.update') }}" method="post">
        @csrf
        <label class="property_block_title  mb-4">Enter your email to reset password</label>
        <input type="hidden" name="token" value="{{$token}}">
        <div class="form-group">
            <label>Email*</label>
            <input type="text" class=" input-action form-control simple @error('email') border-danger @enderror" name = "email" required>
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror

        </div>

        <div class="form-group">
            <label>New Password*</label>
            <input type="password" class="form-control @error('password') border-danger @enderror" name="password" required>
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Confirm New Password*</label>
            <input type="password" class="form-control " name="password-confirmation" required>
        </div>


        <button type="submit"  class="btn mt-4 bg-primary text-white">
            Submit <i class="fas fa-arrow-right me-1"></i>
        </button>
    </form>
@endsection
