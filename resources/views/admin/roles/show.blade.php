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
                                    <h4 class="mb-sm-0 font-size-18">Users with {{ $role->name }} Role</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                                            <li class="breadcrumb-item active">{{ $role->name }}</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
            <!-- end page title -->

                <div class="card">
                    <div class="card-body">


                        <div class="filter">


                            {{-- <div class="collapse {{ $search['q'] ? 'show' : ''}}" id="collapseFilter">
                                <form action="{{ route('admin.administrator.index') }}">
                                    <input type="hidden" name="limit" value="{{ $search['limit'] }}">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="text" name="q" value="{{ $search['q'] }}" class="form-control form-control-sm"
                                                placeholder="Entrez le nom de l'utilisateur...">
                                        </div>
                                        <div class="col-md-2 text-right d-flex align-items-end justify-content-end mt-3 mt-md-0">
                                            <button class="btn btn-success btn-sm" type="submit">Filtrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                        </div>



                        <div class="table-responsive">
                            <table class="table table-centered table-striped">
                                <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Users with role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr role="row">
                                        <td>{{ $loop->index + 1 }}</td>

                                         <td>
                                           <div class="table-user">
                                                {{ $user->name }}
                                            </div>


                                        <td>


                                            <a href="{{ route('admin.administrator.index', $user->id) }}"
                                            class="btn btn-success btn-sm text-white" title="View">
                                                <i class="fa fa-eye"></i></a>


                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Users with {{ $role->name }} role found.</td>
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

@section('footer_script')
    <script></script>
@endsection
