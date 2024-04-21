<form x-data="{ isModalOpen : @entangle('showModal') }" wire:submit.prevent="save">
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
                <h5 class="modal-title" id="exampleModalLongTitle">Add Trip</h5>
            </div>
            <div class="modal-body row">
                <div class=" form-group col-12">
                    <label>Title<span class="text-danger">*</span></label>
                    <input type="text" wire:model="title" class="form-control">
                    @error('title') <span class="error"> {{ $message }} </span> @enderror
                </div>

                <div class=" form-group col-12">
                    <label>Location<span class="text-danger">*</span></label>
                    <input type="text" wire:model="location" wire:change='add_site' class="form-control">
                    @error('location') <span class="error"> {{ $message }} </span> @enderror
                </div>

                <div class="form-group col-6">
                    <a href="{{$location_site}}" class="btn btn-primary form-control" target="_blank">View Itinary</a>
                </div>

                <div class="form-group col-6">
                    <a href="{{$booking_site}}" class="btn btn-secondary form-control" target="_blank">Hotels In This Location</a>
                </div>

                <div class=" form-group col-12">
                    <label>Distance(In Km)<span class="text-danger">*</span></label>
                    <input type="number" wire:model="distance" class="form-control" placeholder="Please enter the distance of the track">
                    @error('distance') <span class="error"> {{ $message }} </span> @enderror
                </div>
                <div class=" form-group col-12">
                    <label>Price/Person(In Euro)<span class="text-danger">*</span></label>
                    <input type="number" wire:model="hotel_price" class="form-control" placeholder="Please enter the price of the hotel see on the site">
                    @error('hotel_price') <span class="error"> {{ $message }} </span> @enderror
                </div>
        
                <div class=" form-group col-12">
                    <label>Description<span class="text-danger">*</span></label>
                    <x-wysiwyg
                        wire:model="description"
                        wire:key="uniqueKey"
                        id="description"
                        class="description form-input rounded-md shadow-sm mt-1 block w-full"
                        rows="20"
                        autocomplete="description"
                    />
                    @error('description') <span class="error"> {{ $message }} </span> @enderror
                </div>

                <div class=" form-group col-12">
                    <label>Beginn Datum<span class="text-danger">*</span></label>
                    <input type="date" onClick="this.showPicker" wire:model="start_date" class="form-control">
                    @error('start_date') <span class="error"> {{ $message }} </span> @enderror
                </div>

                <div class=" form-group col-12">
                    <label>End Datum<span class="text-danger">*</span></label>
                    <input type="date" onClick="this.showPicker" wire:model="end_date" class="form-control">
                    @error('end_date') <span class="error"> {{ $message }} </span> @enderror
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                        data-dismiss="modal">Close
                </button>
                <button type="button" wire:click="save" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    Save changes
                </button>
            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
