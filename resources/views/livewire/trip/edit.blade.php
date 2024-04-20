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
                <h5 class="modal-title" id="exampleModalLongTitle">Add {{$type}} blog</h5>
            </div>
            <div class="modal-body row">
                <div class=" form-group col-12">
                    <label>Title<span class="text-danger">*</span></label>
                    <input type="text" wire:model="title" class="form-control">
                    @error('title') <span class="error"> {{ $message }} </span> @enderror
                </div>

                <div class=" form-group col-12">
                    <label>Category<span class="text-danger">*</span></label>
                    <select wire:model="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach

                    </select>
                    @error('category_id') <span class="error"> {{ $message }} </span> @enderror
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


                @if ($type == 'video')
                    <div class=" form-group col-12">
                        <label>Url<span class="text-danger">*</span></label>
                        <input type="text" wire:model="path" class="form-control">
                        @error('path') <span class="error"> {{ $message }} </span> @enderror
                    </div>

                    <label>Preview</label>
                    <div class=" form-group col-12">
                        <div class="row">
                            @if (isset($path))
                                <div class="col-8 mx-1 mb-1" >
                                    <iframe src="{{ $path }}" width="100%" height="400px"></iframe>
                                </div>
                            @endif

                            @if ($isEditMode && !isset($path))
                                <div class="col-8  mx-1 mb-1">
                                    <iframe src="{{ $blog->url() }}" width="100%" height="400px"></iframe>
                                </div>
                            @endif
                        </div>
                    </div>

                @endif

                @if ($type == 'podcast')
                    <div class=" form-group col-12">
                        <label>Url<span class="text-danger">*</span></label>
                        <input type="text" wire:model="path" class="form-control">
                        @error('path') <span class="error"> {{ $message }} </span> @enderror
                    </div>

                    <label>Preview</label>
                    <div class=" form-group col-12">
                        <div class="row">
                            @if (isset($path))
                                <div class="col-8 mx-1 mb-1" >
                                    {!! $path !!}
                                </div>
                            @endif

                            @if ($isEditMode && !isset($path))
                                <div class="col-8  mx-1 mb-1">
                                    {!! $blog->path !!}
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <div class=" form-group col-12">
                    <label>Cover Image<span class="text-danger">*</span></label>
                    <div class="row">
                        @if (isset($image))
                            <div class="col-3 card mx-1 mb-1">
                                <img class="img-fluid p-2" src="{{ $image->temporaryUrl() }}" >
                            </div>
                        @endif

                        @if ($isEditMode && !isset($image))
                            <div class="col-3 card mx-1 mb-1">
                                <img class="img-fluid p-2" src="{{ $blog->coverImage() }}" >
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Image</label>
                        <input type="file" class="form-control" wire:model="image">
                        <div wire:loading wire:target="image">Uploading ...</div>
                        @error('image') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class=" form-group col-12">
                    <label>Date<span class="text-danger">*</span></label>
                    <input type="date" onClick="this.showPicker" wire:model="date" class="form-control">
                    @error('date') <span class="error"> {{ $message }} </span> @enderror
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
