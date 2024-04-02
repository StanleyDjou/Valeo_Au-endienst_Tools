<div>

    <div class="d-flex justify-content-between mb-4 my-4">
        <div class="d-flex">
            <img src="{{$request->user->profile_picture}}" class="rounded-circle" width="80px" alt="">
            <h4 class="mx-2">{{$request->user->first_name.' '.$request->user->last_name}}</h4>
        </div>

        <div class="d-flex">
            <a href="{{route('findpro')}}">
                <button  class="btn btn-primary mx-2 h-100">
                    Find Professional <i class="fa fa-search"></i>
                </button>
            </a>

            <div class="">
                @if ($request->status == App\models\Request::STATUS_PENDING)
                <button href="#" wire:click.prevent="$emitTo('requests.update-status','load',{{$request}}, '{{App\models\request::STATUS_PROCESSING}}')" class="btn btn-primary waves-effect waves-light mr-1 h-100"><i
                        class="fa fa-star mr-1"></i> Mark As Processing </button>
            @endif
            @if ($request->status == App\models\Request::STATUS_PROCESSING)
               <button href="#" wire:click.prevent="$emitTo('requests.update-status','load',{{$request}}, '{{App\models\request::STATUS_ASSIGNED}}')" class="btn btn-success waves-effect waves-light mr-1 h-100"><i
                        class="fa fa-star mr-1"></i> Mark As Assigned </button>
            @endif
                 <button href="#" wire:click.prevent="$emitTo('requests.update-status','load',{{$request}}, '{{App\models\request::STATUS_CANCELLED}}')" class="btn btn-danger waves-effect waves-light mr-1 h-100"><i
                        class="fa fa-bolt mr-1"></i> Cancel </button>
            </div>
        </div>
    </div>
    <div class="row justify-content-between align-items-center">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-14 mb-0">Request Details</h3>
            </div>
        </div>
    </div>

    <div class="mt-5">
       <div class="mb-4">
           <h4>
               {{$request->title}}
           </h4>
       </div>


        <h5>Images</h5>
        <div class="row mb-4">
            @foreach ($request->images as $image)
                <div class="col-6 col-md-3 col-lg-2 card mx-1 mb-1">
                    <img class="img-fluid p-2" src="{{ $image->image }}" >
                </div>
            @endforeach
        </div>


        <h5>Description</h5>
        {!! $request->description !!}

    </div>



    <livewire:requests.update-status />
</div>
