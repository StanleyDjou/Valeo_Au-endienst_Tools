<div>
    <h4>Add New User</h4>

    <div class="p-4 rounded-lg bg-white">
        <span>
            <h6>Select User Role</h6>
            <div class="d-flex ">
                <div class="form-check align-items-center" style="margin-right: 20px">
                    <div class="">
                        <input class="form-check-input" {{$isEditMode ? 'disabled' : ''}} value="worker" wire:model='role'
                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    </div>
    
                    <label class="form-check-label " for="flexRadioDefault1">
                        <div class="">
                            <p class="font-weight-bold font-16 text-dark ms-2">Worker</p>
                        </div>
                    </label>
                </div>
                <div class="form-check align-items-center" style="margin-right: 20px">
                    <div class="">
                        <input class="form-check-input" {{$isEditMode ? 'disabled' : ''}}  value="client" wire:model='role'
                        type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    </div>
    
                    <label class="form-check-label " for="flexRadioDefault2">
                        <div class="">
                            <p class="font-weight-bold font-16 text-dark ms-2">Client</p>
                        </div>
                    </label>
                </div>
            </div>

        </span>
    </div>

    <div class="mt-4 p-4 rounded-lg bg-white">
        <h4>Personal Information</h4>

        <div class="d-flex align-items-center g-3 py-5">
            @if (!isset($new_profile))
                <img class="bg-white img-fluid p-4 me-5 border signature-image" style="max-width:  150px"
                     src="{{ !isset($old_profile)?  asset('be_assets/images/Frame 75.png') : asset('storage/'.$user->profile) }}">
            @else
                <img class="bg-white img-fluid p-4 me-5 border signature-image"  style="max-width:  150px"
                     src="{{ $new_profile->temporaryUrl() }}">
    
            @endif
    
            <label for="profile" class="rounded-sm border border-primary p-2 mx-4 text-primary border-black "><i class="fa fa-upload"></i>Upload Profile Photo</label>
            <input type="file" class="d-none" wire:model='new_profile' id="profile">
        </div>
    
    
        <div class="row py-5">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">First Name <span class="required-field">*</span></label>
                    <input type="text" wire:model="first_name" class="form-control" >
                    @error('first_name') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">Last Name <span class="required-field">*</span></label>
                    <input type="text" wire:model="last_name" class="form-control" >
                    @error('last_name') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">Email <span class="required-field">*</span></label>
                    <input type="email" wire:model="email" class="form-control" >
                    @error('email') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">Phone Number<span class="required-field">*</span></label>
                    <input type="text" wire:model="phone" class="form-control" >
                    @error('phone') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="form-group">
                    <label class="font-15" for="">Password<span class="required-field">*</span></label>
                    <div class="input-group">
                        <input type="text" {{$isEditMode ? 'disabled' : ''}} wire:model="password" class="form-control bl-none">
                    </div>
                    @error('password') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center justify-content-start">
                <button class="rounded-lg bg-white border border-primary p-2 mt-3  text-primary border-black " {{$isEditMode ? 'disabled' : ''}} wire:click='generate' wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="generate"></i>
                    <i class="fa fa-lock"></i> Generate Strong Password</button>
            </div>

         
                <div class=" col-12 d-flex align-items-center">
                    <h6 class="me-2">Status : </h6>
                    <div style="width: 5px"></div>
                    <div class="form-check form-switch ">
                        <input class="form-check-input ms-2" type="checkbox" wire:model = 'status' role="switch" id="flexSwitchCheckChecked" >
                        <label class="form-check-label" for="flexSwitchCheckChecked">{{$status == 0 ? 'Inactive' : 'Active'}}</label>
                    </div>
                </div>
    
                <div class=" col-12 mt-4 d-flex align-items-center">
                    <div class="form-check form-switch ">
                        <input class="form-check-input ms-2" type="checkbox" wire:model = 'check' role="switch" id="emailcount" checked >
                        <label class="form-check-label" for="emailcount">Send account details via Email</label>
                    </div>
                </div>
     


        </div>
    </div>

    @if ($role == 'worker')
        <div class="mt-4 p-4 row rounded-lg bg-white">
            <h4>Business Information</h4>
            <div class="col-12">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">Company Name <span class="required-field">*</span></label>
                    <input type="text" wire:model="company" class="form-control" >
                    @error('company') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">Address <span class="required-field">*</span></label>
                    <input type="text" wire:model="address" class="form-control" >
                    @error('address') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">City <span class="required-field">*</span></label>
                    <input type="text" wire:model="city_id" class="form-control" >
                    @error('city_id') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">Region <span class="required-field">*</span></label>
                    <input type="text" wire:model="region_id" class="form-control" >
                    @error('region_id') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            {{-- <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">Category <span class="required-field">*</span></label>
                    <input type="text" wire:model="category" class="form-control" >
                    @error('category') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">Sub Category <span class="required-field">*</span></label>
                    <input type="text" wire:model="sub_category" class="form-control" >
                    @error('sub_catergory') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div> --}}
            <div class="col-12 ">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for="">Website <span class="required-field">*</span></label>
                    <input type="text" wire:model="website" class="form-control" >
                    @error('website') <span class="error"> {{ $message }} </span> @enderror
                </div>
            </div>
        </div>
    @endif

    <button type="button" class="btn bt-sm btn-primary border-0 mt-5" {{$saved? 'disabled' : ''}} wire:click = 'save'>
        {{$isEditMode ? 'Update User' : 'Create New User'}}
    </button>

</div>
