<div>
    <div class="row justify-content-between align-items-center">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-14 mb-0">Trip Detail</h3>
            </div>
            <div>
                @if ($trip->state == 'planned')
                    <a href="#" wire:click.prevent="$emitTo('trip.update-status','load', {{$trip}}, 'ongoing')"
                    class="btn btn-secondary"> Mark as On Going</a>
                @endif
                @if ($trip->state == 'ongoing')
                    <a href="#" wire:click.prevent="$emitTo('trip.update-status','load', {{$trip}}, 'passed')"
                    class="btn btn-secondary"> Mark as Completed</a>
                @endif

                @if ($trip->state == 'planned')
                    <a href="#"  wire:click.prevent="$emitTo('trip.add-workers','load',{{$trip->id}})" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                        <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                        Add Worker
                    </a>   
                @endif
               
            </div>
        </div>
    </div>

    <div class="mt-5">
       <div class="mb-4">
        <h5>Title</h5>
           <h4>
               {{$trip->title}}
           </h4>

           <span>
                    <h5>Status</h5>
                    <div class="badge badge-success">
                        {{ucfirst($trip->state)}} </div>
            </span>

       </div>




        <h5>Description</h5>
        {!! $trip->description !!}


        <h5>From</h5>
        {{$trip->start_date}}
        <h5>To</h5>
        {{$trip->end_date}}


        <h4 class="my-4 pt-4"> Trip Workers</h4>

        <div class="table-responsive">
            <table class="table table-bordered m-0">
    
                <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($workers as $k=>$worker)
                    <tr wire:key="{{$k}}">
                        <td>{{$loop->index + 1}}</td>
                        <td>
                            <div class="d-flex">
                                {{$worker->user->first_name}}
                            </div>
                        </td>
                        <td>
                            {{$worker->user->last_name}}
                        </td>
                        <td>
                            {{$worker->role}}
                        </td>
                        <td>
                            <div class="button-list">
                                <a href="#" wire:click.prevent="$emitTo('trip.remove-worker','load', {{$trip}},{{$worker->user}})"
                                    class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                            </div>
                        </td>
    
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class=" text-center">No User Found</td>
                    </tr>
                @endforelse
    
                </tbody>
            </table>
        </div>

        <div class="modal-footer">

            <a  href="{{route('trip.evaluate', $trip)}}" class="btn btn-secondary" >
                <i class="fa fa-spinner d-none"></i>
               Evaluate Trip Cost
            </a>
        </div>

    <livewire:trip.add-workers  />
    <livewire:trip.remove-worker  />
    <livewire:trip.update-status  />
</div>
