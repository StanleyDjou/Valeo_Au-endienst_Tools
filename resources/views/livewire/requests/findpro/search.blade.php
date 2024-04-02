<form x-data="{ isModalOpen : @entangle('showModal') }" wire:submit.prevent="">
    <div
        class="modal"
        role="dialog"
        tabindex="-1"
        x-show="isModalOpen"
        x-cloak
        x-transition
    >
        <div class="modal-inner">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Find Worker</h4>
            </div>
            
            <div class="modal-body row">
                <p class="mx-3">Query database to get your desired worker</p>
                <div class="form-group col-12">
                    <label class="font-weight-bold">Search Company Name</label>
                    <input type="text" wire:model="search_value" wire:keydown='search' class="form-control">
                    @error('search_value') <span class="error"> {{ $message }} </span> @enderror
                </div>
                <div class="px-2">
                  
                        @forelse ($search_array as $item)
                            <a class="mb-2 d-block text-dark" href="{{route('user.detail', $item)}}"><i class="mx-3"><img src="{{asset('images/Vector.png')}}" alt=""></i>{{$item->company}}</a>
                            @empty
                                <div class="{{$search_value==''? 'd-none' : ''}}">
                                    <p class="mb-2 "><i class="mx-3 fa fa-times"></i>No Match Found</p>
                                </div>
                        @endforelse
                    
                </div>
                <div class="form-group col-12">
                    <button class="d-flex justify-content-between rounded-sm form-control  py-1 px-2  bg-blue-light " wire:click = 'setAdvance'>
                        Advanced Search
                        <i class="fa {{$advance_search? 'fa-chevron-down' : 'fa-chevron-up'}}"></i>
                    </button>
                </div>
                <div class="form-group {{$advance_search? 'd-none' : ''}} col-12">
                    <select  wire:model="category" wire:change='set_sub'  class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $cat)
                            <option  value="{{$cat->name}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{$advance_search? 'd-none' : ''}} col-12">
                    <select  wire:model="sub_category" class="form-control">
                        <option value="">Select Sub Category</option>
                        @foreach ($sub_categories as $sub)
                            <option value="{{$sub->name}}">{{$sub->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{$advance_search? 'd-none' : ''}} col-12">
                    <select  wire:model="region" wire:change='set_cities'  class="form-control">
                        <option value="">Select Region</option>
                        @foreach ($regions as $reg)
                            <option  value="{{$reg->name}}">{{$reg->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{$advance_search? 'd-none' : ''}} col-12">
                    <select  wire:model="city" class="form-control">
                        <option value="">Select City</option>
                        @foreach ($cities as $cit)
                            <option value="{{$cit->name}}">{{$cit->name}}</option>
                        @endforeach
                    </select>
                    @error('search_value') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>

            <div class="container mx-1">
                <button type="button" wire:click="save" class="btn bg-primary  p-2 px-5" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    Find
                </button>
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn border border-primary bg-none text-primary p-2 px-4"
                        data-dismiss="modal">Close
                </button>

            </div>



        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
