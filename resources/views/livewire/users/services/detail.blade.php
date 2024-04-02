<div>
    <div class="row justify-content-between align-items-center">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-14 mb-0">Service Details</h3>
            </div>
        </div>
    </div>

    <div class="mt-5">
       <div class="mb-4">
           <h4>
               {{$service->title}}
           </h4>
       </div>

       <h5>Skills</h5>
       <div class="row mb-4">
           @foreach ($service->skills() as $skill)
               <div class="">
                  <li>{{$skill->name}}</li>
               </div>
           @endforeach
       </div>

        <h5>Images</h5>
        <div class="row mb-4">
            @foreach ($service->images as $image)
                <div class="col-6 col-md-3 col-lg-2 card mx-1 mb-1">
                    <img class="img-fluid p-2" src="{{ $image->image }}" >
                </div>
            @endforeach
        </div>


        <h5>Description</h5>
        {!! $service->description !!}

    </div>
</div>
