@extends('layouts.app')
@section('title', 'New Roles')

@section('content')
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
                                            <li class="breadcrumb-item active">Create new Role</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


    <div class="card">
        <div class="card-body">
            <div class="card-box">
                <div class="px-4">
                    <h4 class="page-title my-2">Enter Role details below</h4>
                    <form method="post" action="{{route('admin.roles.store')}}">
                        @csrf
                       <div class="row">
                           <div class="form-group col-sm-12">
                               <label for="firstname">Name</label>
                               <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{old('name')}}" name="name" placeholder="Enter name of Role">
                               @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                               @enderror
                           </div>

                           @foreach(\App\Models\Permissions::all() as $p)
                               <div class="col-md-3 my-2">
                                   <div class="form-check">
                                       <input type="checkbox" value="{{$p->id}}" name="permissions[]" class="form-check-input">
                                       <label class="form-check-label">{{$p->name}}</label>
                                   </div>
                               </div>
                           @endforeach
                       </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mb-3">
                                    <a href="{{route('admin.roles.index')}}" type="button" class="btn w-sm btn-light waves-effect">Cancel</a>
                                    <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Save</button>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </form>
                </div>
            </div> <!-- end card-box-->
        </div>
    </div>
    </div>
    </div>
    </div>


@endsection




