<div>
    <div class="d-flex mb-5 justify-content-between align-items-center">
        <h4 class="text-capitalize">Manage Trips</h4>
    </div>
    <button wire:click.prevent="$emitTo('trip.edit','load')" class="btn bg-primary text-white" wire:loading.attribute='disabled'>
        <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none" wire:target="load"></i>
        Add New Trip
    </button>

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
                <th>Title</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($trips as $k=>$trip)
                <tr wire:key="{{$k}}">
                    <td>{{$loop->index + 1}}</td>
                    <td>
                        <div class="d-flex">
                            {{$trip->title}}
                        </div>
                    </td>
                    <td>
                        {{$trip->location}}
                    </td>
                    <td>
                        {{$trip->start_date}}
                    </td>
                    <td>{{$trip->end_date}} </td>
                    <td> <div class="p-2 rounded badge badge-success ">{{$trip->state}}</div> </td>
                    <td>
                        <div class="button-list">
                            <a href="{{route('trip.detail', $trip)}}" class="btn btn-primary"><i
                                class="fa fa-eye"></i> </a>
                                <a href="#" wire:click.prevent="$emitTo('trip.edit','load',{{$trip}})"
                                class="btn btn-dark"><i class="fa fa-pen"></i></a>
                            <a href="#" wire:click.prevent="$emitTo('trip.delete','load',{{$trip}})"
                                class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" class=" text-center">No Trip Found</td>
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
    <livewire:trip.delete />
    <livewire:trip.edit />
</div>
