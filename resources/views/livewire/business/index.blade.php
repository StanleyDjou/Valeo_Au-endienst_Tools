<div>
    <div class="d-flex mb-5 justify-content-between align-items-center">
        <h4 class="text-capitalize">Manage Users</h4>
    </div>


    <div class="row justify-content-end mb-3">
        <div class="col-md-6 col-lg-4">
            <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm"
                   placeholder="Type to Search">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Location</th>
                <th>Joined On</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $k=>$user)
                <tr wire:key="{{$k}}">
                    <td>{{$loop->index + 1}}</td>
                    <td>
                        <div class="d-flex">
                            <img src="{{$user->profile_picture}}" alt="user-image" width="60px" class="rounded-circle mx-2">
                            {{$user->company}}
                        </div>
                    </td>
                    <td>
                        {{$user->services()->first()}}
                    </td>
                    <td>
                        {{$user->services()->first()}}
                    </td>
                    <td>{{$user->city.' '.$user->region}} </td>
                    <td>{{$user->created_at  }} </td>
                    <td class="p-2">
                        <div class=" p-2 rounded-lg badge badge-{{$user->status == '1' ? 'success' : 'processing'}}">
                            {{$user->status == '1' ? 'Active' : 'Inactive'}}
                        </div>
                         </td>
                    <td>
                        <div class="button-list">
                            <a href="{{route('user.detail', $user)}}" class="btn btn-primary"><i
                                class="fa fa-eye"></i> </a>
                            <a href="{{route('edit.user', ['user' => $user->id])}}" 
                                class="btn btn-dark"><i class="fa fa-pen"></i></a>
                            <a href="#" wire:click.prevent="$emitTo('users.delete','load',{{$user}})"
                                class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" class=" text-center">No Businesses Found</td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>

        {{-- Pagination --}}
        @if($this->rows->count())
            <div class="mt-5">
                {{ $this->rows->links() }}
            </div>
        @endif
        {{-- / Pagination --}}
    <livewire:users.delete />
</div>
