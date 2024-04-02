@extends('layouts.app')
@section('title', 'Roles')



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
                            <h4 class="mb-sm-0 font-size-18">Roles</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Roles</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card">
                    <div class="card-body">


                        <div class="filter">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="d-flex flex-nowrap justify-content-end w-100 align-items-center">

                                    <a href="{{route('admin.roles.create')}}" class="btn btn-success text-white btn-sm">New
                                        Role</a>
                                </div>
                            </div>

                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered m-0">
                                <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($roles as $role)
                                    <tr role="row">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <div class="table-user">
                                                <a href="{{ route('admin.roles.show', $role->id) }}"

                                                   class="text-body font-weight-semibold">{{ $role->name }}</a>
                                            </div>
                                        </td>

                                        <td>

                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                               class="btn btn-success btn-sm text-white" title="edit">
                                                <i class="fa fa-pen"></i></a>

                                            <a href="{{ route('admin.roles.show', $role->id) }}"
                                               class="btn btn-success btn-sm text-white" title="View">
                                                <i class="fa fa-eye"></i></a>

                                            <form method="POST" class="d-inline-flex"
                                                  action="{{ route('admin.roles.destroy', $role->id) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-primary"><span
                                                        class="fa fa-trash"></span></button>
                                            </form>
                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Roles found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
