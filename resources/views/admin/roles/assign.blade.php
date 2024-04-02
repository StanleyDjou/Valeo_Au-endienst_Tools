@extends('layouts.app')
@section('title', 'Assign Roles')
@section('content')
    <!-- Breadcubs Area End Here -->
    <!-- Add Expense Area Start Here -->

    <div class="main-content">

        <div class="page-content">
                <div class="container-fluid">

                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0 font-size-18">Roles</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Roles</a></li>
                                                <li class="breadcrumb-item active">Assign Role</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3 class="page-title my-2">Assign New Role</h3>
                    </div>
                </div>
                <form class="new-added-form" method="post" action="{{route('admin.roles.assign.post')}}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Select User</label>
                            <select name="user_id" class="select2 form-control" required>

                                    <option value="">Please Select User</option>
                                    @foreach($users as $user)

                                            <option  value="{{$user->id}}"> {{$user->name}}</option>

                                    @endforeach

                            </select>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>Select Role</label>
                            <select name="role_id" class="select2 form-control" required>
                                <option>Please Select Role</option>
                                @foreach(\App\Models\Role::get() as $role)

                                        <option value="{{$role->id}}">{{$role->name}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="text-center mb-3">
                                <a href="{{route('admin.roles.index')}}" type="button" class="btn w-sm btn-light waves-effect">Cancel</a>
                                <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection



