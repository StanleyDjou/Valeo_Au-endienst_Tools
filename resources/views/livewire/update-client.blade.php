<div>
    <h5>Client Profile</h5>


    <div class="d-flex align-items-center g-3 py-5">
        @if (!isset($profile_picture))
            <img class="bg-white img-fluid p-4 me-5 border signature-image" style="max-width: 150px"
                 src="{{ asset('storage/'.$client->logo) }}">


        @else
            <img class="bg-white img-fluid p-4 me-5 border signature-image"  style="max-width:  150px"
                 src="{{ $profile_picture->temporaryUrl() }}">

        @endif

        <label for="profile" class="btn btn-dark border-black "><i class="fa fa-upload"></i>Upload Logo</label>
        <input type="file" class="d-none" wire:model='profile_picture' id="profile">
    </div>

    <div class="">
        <div class="form-group">
            <label class="font-15" for="">Client Name <span class="required-field">*</span></label>
            <input type="text" wire:model="name" class="form-control" >
            @error('name') <span class="error"> {{ $message }} </span> @enderror
        </div>
    </div>
    <div class="row py-5">
        <div class="col-lg-6 mt-3">
            <div class="form-group">
                <label class="font-15" for="">Billing Address<span class="required-field">*</span></label>
                <input  wire:model="billing_address" type="text" class="form-control">
            </div>
        </div>
        <div class="col-lg-6 mt-3">
            <div class="form-group">
                <label class="font-15" for="">Shipping Address<span class="required-field">*</span></label>
                <input  wire:model="shipping_address" type="text" class="form-control">
            </div>
        </div>
        <div class="col-lg-6 mt-3">
            <div class="form-group">
                <label class="font-15" for="">Phone<span class="required-field">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><img
                                src="{{asset('assets/icons/icons8_usa 1.png')}}" alt=""></div>
                    </div>
                    <input type="tel" wire:model="phone" class="form-control bl-none">
                </div>
                @error('phone') <span class="error"> {{ $message }} </span> @enderror
            </div>
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

    </div>


    <button type="button" class="btn bt-sm btn-danger border-0 mt-5" wire:click = 'update'>
        Save Changes
    </button>

</div>
