<div>
    <div class="d-flex mb-5 justify-content-between align-items-center">
        <h4 class="text-capitalize">Search Results</h4>
    </div>
    <div class="rounded-lg bg-white p-2 py-4">
        <div class="d-flex justify-content-start">
            <div class=" mb-3 mx-2">
                <div class="">
                    <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm"
                           placeholder="Type to Search">
                </div>
            </div>
    
            <div class="form-group ">
                <select  wire:model.debounce.500ms="filters.category" wire:change='set_sub'  class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($categories as $cat)
                        <option  value="{{$cat->name}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mx-2">
                <select  wire:model="sub_category" class="form-control">
                    <option value="">Select Sub Category</option>
                    @foreach ($sub_categories as $sub)
                        <option value="{{$sub->name}}">{{$sub->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ">
                <select  wire:model.debounce.500ms="filters.region" wire:model='region' wire:change='set_cities'  class="form-control">
                    <option value="">Select Region</option>
                    @foreach ($regions as $reg)
                        <option  value="{{$reg->name}}">{{$reg->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ml-2">
                <select  wire:model="filters.region" class="form-control">
                    <option value="">Select City</option>
                    @foreach ($cities as $cit)
                        <option value="{{$cit->name}}">{{$cit->name}}</option>
                    @endforeach
                </select>
                @error('search_value') <span class="error"> {{ $message }} </span> @enderror
            </div>
        </div>

        <div class="d-flex mb-2 mt-2 mx-2 justify-content-between align-items-center">
            <h4 class="text-capitalize">Showing 50 Web Development Businesses</h4>
        </div>

        <div class="row p-2">
            @foreach ($businesses as $business)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="d-flex">
                            <div>
                                <img src="{{$business->profile_picture}}" class="rounded-lg" width="100px" alt="User Profile">
                            </div>
                            <div class="ml-3 d-flex align-items-start">
                                <span>
                                    <p class="font-24 font-weight-bold">{{$business->company}}</p>
                                    <p>Software Development | Web Development</p>
                                    <div>
                                        <p>
                                            <i class="mx-3"> <img src="{{asset('images/location.png')}}" alt=""></i>
                                            Buea,  SouthWest
                                        </p>
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-phone"></i> Call User
                                        </button>
                                                                            
                                        <button class="btn bg-blue-light text-primary mx-1">
                                            <i class="fa fa-envelope"></i> Email User
                                        </button>

                                        <button class="btn bg-none border-primary text-primary">
                                            <i class="fa fa-envelope"></i> View Details
                                        </button>
                                  
                                    </div>

                                </span>
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>









    <livewire:requests.findpro.search :showModal="$showModal" />
</div>
