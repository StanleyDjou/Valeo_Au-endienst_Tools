@extends('layouts.app')
@section('title', 'Roles Edit')
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
                                        <h4 class="mb-sm-0 font-size-18">{{ $role->name }} Role Edit</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Roles</a></li>
                                                <li class="breadcrumb-item active">Edit Role</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3 class="page-title my-2">Edit {{$role->name}} Role</h3>
                                    </div>
                                </div>
                                <form class="new-added-form" method="post" action="{{route('admin.roles.update', $role->slug)}}">
                                    @csrf
                                    <input type="hidden" name="_method" value="put">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label>Name *</label>
                                            <input type="text" name="name" value="{{$role->name}}" placeholder="" class="form-control">
                                        </div>
                                        <div class="row my-5 mx-3">
                                            @foreach(\App\Models\Permissions::all() as $p)
                                                <div class="col-md-3 my-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" {{($role->permissions->contains($p))?'checked':''}} value="{{$p->id}}" name="permissions[]" class="form-check-input">
                                                        <label class="form-check-label">{{$p->name}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
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
    </div>

@endsection



