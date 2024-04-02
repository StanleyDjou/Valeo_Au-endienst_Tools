@extends('layouts.header')
@section('header-content')


    <div class="neutral" style="height: 100vh; padding-top:20px">
        <div class ="login-form neutral">
            <div class = "container ">
                <div >
                    <div class="row pt-5">
                        <div class=" col-12 col-xl-7">
                            <div class="">
                                <div class="login" style="">
                                    <div class="">
                                        <div class="property_block_wrap_header">
                                            <h4 class="property_block_title">Verify Email</h4>
                                        </div>

                                        <div class="block-body">
                                            <br>
                                            @if (session('resent'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                                </div>
                                            @endif

                                            {{ __('Before proceeding, please check your email for a verification link.') }}
                                            {{ __('If you did not receive the email') }},
                                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                                @csrf
                                                <button type="submit" class="btn border-0 btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
