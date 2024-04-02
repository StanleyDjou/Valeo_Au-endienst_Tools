@extends('layouts.app')
@section('title', 'Edit Administrators')

@section('content')
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
                                            <li class="breadcrumb-item active">Edit an Administrator</li>
                                            <li class="breadcrumb-item active">{{ $admin->email }}</li>
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
                    <h4 class="page-title my-2">Edit administrator details below</h4>
                    <form method="post" action="{{route('admin.administrator.update', $admin->id)}}">
                        @csrf
                        @method('PUT')
                       <div class="row">
                           <div class="form-group col-md-6">
                               <label for="firstname">Name</label>
                               <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name', $admin->name) }}"
                               name="name" placeholder="Enter name of administrator">
                               @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                               @enderror
                           </div>

                           <div class="form-group col-md-6">
                               <label for="role">Role</label>
                               <select class="form-control {{ $errors->has('role') ? 'error' : '' }} select2" required name="role" id="role">
                                   <option value="" selected disable hidden>Select role</option>
                                   @foreach ($roles as $role )
                                       <option {{old('role',$admin->roleR->first()?$admin->roleR->first()->role->id:0 ) ==$role->id?'selected':'' }} value="{{ $role->id }}" >{{ $role->name }}</option>
                                   @endforeach
                               </select>
                               @error('role')
                               <span class="invalid-feedback">{{ $message }}</span>
                               @enderror
                           </div>

                           <div class="form-group col-sm-6">
                               <label>Email</label>
                               <input class="form-control @error('email') is-invalid @enderror" type="email" readonly value="{{old('email', $admin->email)}}"
                               name="email" placeholder="Enter email address of administrator">
                               @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                               @enderror
                           </div>
                           <div class="form-group col-sm-6 @error('phone') is-invalid @enderror">
                               <label>Telephone (+23767....)</label>
                               <input class="form-control @error('phone') is-invalid @enderror" type="number" value="{{old('phone', $admin->phone)}}"
                               name="phone" placeholder="Enter telephone of administrator">
                               @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                               @enderror
                           </div>

                           <div class="form-group col-sm-6">
                               <label for="password">Password</label>
                               <input class="form-control @error('password') is-invalid @enderror" type="password" id="password"
                               name="password"  placeholder="Enter password">
                               @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                               @enderror
                           </div>
                           <div class="form-group col-sm-6">
                               <label for="password">Confirm Password</label>
                               <input class="form-control" type="password" id="password" name="password_confirmation"placeholder="Confirm Password">
                           </div>
                       </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mb-3">
                                    <a href="{{route('admin.administrator.index')}}" type="button" class="btn w-sm btn-light waves-effect">Cancel</a>
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
