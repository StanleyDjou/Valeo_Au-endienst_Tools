@extends('layouts.app')
@section('title', $user->name)
@section('content')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

            <!-- start page title -->
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Administrators</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item active"><a href="{{ route('admin.administrator.index') }}">Administrators</a>
                                            <li class="breadcrumb-item active">{{ $user->name }}</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
            <!-- end page title -->


    <div class="row">
        <div class="card">
            <div class="card-body">
                    <div class="card-box text-center">
                        <img src="{{ $user->image() }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                        <h4 class="mb-0">{{ $user->name }}</h4>
                        <p class="text-muted">{{ $user->email }}</p>
                        <hr>
                        <div class="text-left mt-3">
                            <p class="text-muted mb-2 font-13">
                                <strong>Name :</strong> <span class="ml-2">{{ $user->name }}</span>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <strong>Telephone :</strong><span class="ml-2">{{ $user->phone ?: 'N/A' }}</span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Email :</strong> <span class="ml-2 ">{{ $user->email }}</span></p>

                            <p class="text-muted mb-1 font-13">
                                <strong>Adresse :</strong> <span class="ml-2">{{ $user->address ?: 'N/A' }}</span></p>

                        </div>
                        <hr>
                        <form  action="{{route('admin.administrator.destroy',($user->id))}}" method="POST">
                            @method('DELETE')
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs btn-block  waves-effect mb-2 waves-light">
                                Delete <span class="fa fa-trash"></span>
                            </button>
                        </form>

                    </div> <!-- end card-box -->

            </div>
        </div>

    </div>

@endsection

@section('footer_script')
    <script></script>
@endsection
