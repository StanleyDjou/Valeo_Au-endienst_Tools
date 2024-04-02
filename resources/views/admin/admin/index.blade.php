@extends('layouts.app')
@section('title', 'Administrators')

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Administrators</li>
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
                                    <a href="{{route('admin.administrator.create')}}"
                                       class="btn btn-success text-white btn-sm">New Administrator</a>
                                </div>
                            </div>

                            <div class="collapse {{ $search['q'] ? 'show' : ''}}" id="collapseFilter">
                                <form action="{{ route('admin.administrator.index') }}">
                                    <input type="hidden" name="limit" value="{{ $search['limit'] }}">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="text" name="q" value="{{ $search['q'] }}"
                                                   class="form-control form-control-sm"
                                                   placeholder="Entrez le nom de l'utilisateur...">
                                        </div>
                                        <div
                                            class="col-md-2 text-right d-flex align-items-end justify-content-end mt-3 mt-md-0">
                                            <button class="btn btn-success btn-sm" type="submit">Filtrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered m-0">
                                <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Admin</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($admins as $admin)
                                    <tr role="row">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <div class="table-user">
                                                <a href="{{ route('admin.administrator.show', $admin->id) }}"

                                                   class="text-body font-weight-semibold">{{ $admin->name }}</a>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $admin->email ?: 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $admin->roleR->first()?$admin->roleR->first()->role->name:"N/A" }}
                                        </td>

                                        <td>

                                            <a href="{{ route('admin.administrator.edit', $admin->id) }}"
                                               class="btn btn-success btn-sm text-white" title="View">
                                                <i class="fa fa-pen"></i></a>

                                            <a href="{{ route('admin.administrator.show', $admin->id) }}"
                                               class="btn btn-success btn-sm text-white" title="View">
                                                <i class="fa fa-eye"></i></a>

                                            <form method="POST" class="d-inline-flex"
                                                  action="{{ route('admin.administrator.destroy', $admin->id) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-primary"><span
                                                        class="fa fa-trash"></span></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No administrator found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
