<div>
    <div class="d-flex mb-5 justify-content-between align-items-center">
        <h4 class="text-capitalize">Manage Requests</h4>
    </div>


    <div class="rounded-lg bg-white p-2 py-4">
        <div class="d-flex justify-content-end">
            <div class=" mb-3 mx-2">
                <div class="">
                    <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm"
                           placeholder="Type to Search">
                </div>
            </div>

            <div>
                <select name="Category" class="form-control rounded-md " id="">
                    <option value="">Category</option>
                </select>
            </div>
            <div class="mx-2">
                <select name="" class="form-control rounded-md " id="">
                    <option value="">Sub Category</option>
                </select>
            </div>
            <div>
                <select name="" class="form-control rounded-md " id="">
                    <option value="">Region</option>
                </select>
            </div>
            <div class="mx-2">
                <select name="" class="form-control rounded-md " id="">
                    <option value="">City</option>
                </select>
            </div>
            <div >
                <select name="" class="form-control rounded-md " id="">
                    <option value="">Status</option>
                </select>
            </div>
        </div>

    
        <div class="table-responsive bg-white">
            <table class="table table-bordered m-0 rounded-lg">
    
                <thead class="bg-light">
                <tr >
                    <th>#</th>
                    <th>Sender</th>
                    <th>Title & Description</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Requested On</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($requests as $k=>$request)
                    <tr wire:key="{{$k}}">
                        <td>{{$loop->index + 1}}</td>
                        <td>
                            <div class="d-flex">
                                <img src="{{$request->user->profile_picture}}" class="rounded-circle" width="50px" alt="">
                                <p class="mx-2">{{$request->user->first_name}}</p>
                            </div>
                        </td>
                        <td>
                            <span>
                                <p class="font-weight-bold">
                                    {{$request->title}}
                                </p>
                                <p>
                                    {!! $request->description !!}
                                </p>
                            </span>


                            
                        </td>
                        <td>
                            {{$request->user->first_name.' '.$request->user->last_name}}
                        </td>
                        <td>{{$request->date}} </td>
                        <td>{{$request->created_at  }} </td>
                        <td class="p-2">
                            <div class=" p-2 rounded-lg badge badge-{{$request->status}}">
                                {{ucfirst($request->status)}}
                            </div>
                             </td>
                        <td>
                            <div class="button-list">
                                <a href="{{route('requests.detail', $request)}}" class="btn btn-primary"><i
                                    class="fa fa-eye"></i> </a>
                            </div>
                        </td>
    
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class=" text-center">No requests found</td>
                    </tr>
                @endforelse
    
                </tbody>
            </table>
        </div>
    </div>


        {{-- Pagination --}}
        @if($this->rows->count())
            <div class="mt-5">
                {{ $this->rows->links() }}
            </div>
        @endif
        {{-- / Pagination --}}
</div>
