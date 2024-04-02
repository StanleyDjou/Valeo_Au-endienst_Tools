<div>
    <h5>User Profile</h5>

    <div class="d-flex align-items-center g-3 py-5">
        @if (!isset($profile_picture))
            <img class="bg-white img-fluid p-4 me-5 border signature-image" style="max-width:  150px"
                 src="{{ asset('storage/'.$user->profile) }}">


        @else
            <img class="bg-white img-fluid p-4 me-5 border signature-image"  style="max-width:  150px"
                 src="{{ $profile_picture->temporaryUrl() }}">

        @endif

        <label for="profile" class="rounded-sm border border-primary p-2 mx-4 text-primary border-black "><i class="fa fa-upload"></i>Upload Profile Photo</label>
        <input type="file" class="d-none" wire:model='profile_picture' id="profile">
    </div>

    <div class="">
        <div class="form-group">
            <label class="font-15" for="">Full Name <span class="required-field">*</span></label>
            <input type="text" wire:model="title" class="form-control" >
            @error('title') <span class="error"> {{ $message }} </span> @enderror
        </div>
    </div>
    <div class="row py-5">
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
        <div class="col-lg-6 mt-3">
            <div class="form-group">
                <label class="font-15" for="">Email<span class="required-field">*</span></label>
                <input readonly wire:model="email" type="text" class="form-control">
            </div>
        </div>
    </div>


    <button type="button" class="btn bt-sm btn-primary border-0 mt-5" wire:click = 'update'>
        Save Changes
    </button>

</div>
