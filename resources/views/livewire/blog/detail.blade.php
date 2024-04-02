<div>
    <div class="row justify-content-between align-items-center">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-14 mb-0">Blog Details</h3>
            </div>
            <div>
                <a href="#" wire:click.prevent="$emitTo('blog.publish','load',{{$blog}})"
                class="btn btn-secondary"> {{$blog->status==="published"?"un-Publish":"Publish"}}</a>

                <a href="#"  wire:click.prevent="$emitTo('blog.edit','load',{{$blog}})" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    Update Blog
                </a>
            </div>
        </div>
    </div>

    <div class="mt-5">
       <div class="mb-4">
           <h4>
               {{$blog->title}}
           </h4>
           <span>
                <h5>Category</h5>
                {{$blog->category->name}}
           </span>

           <span>
                    <h5>Status</h5>
                    <div class="badge {{$blog->status == 'draft'? 'badge-draft' : 'badge-success'}}">
                        {{ucfirst($blog->status)}} </div>
            </span>

       </div>

        <div class="row">
            <div class="col-md-6 col-lg-4 col-xl-3">
                <img class="img-fluid p-2" src="{{ $blog->coverImage() }}" >
            </div>
        </div>

        <h5>Type</h5>
        {{ucfirst($blog->type)}}

        @if ($blog->type == 'podcast')
             <h5>Preview</h5>
            <div class="col-12 ">
                {!! $blog->path !!}
            </div>
        @endif

        @if ($blog->type == 'video')
            <h5>Preview</h5>
                <div class="row">
                    <div class="col-8 mx-1 mb-1" >
                        <iframe src="{{ $blog->url() }}" width="100%" height="400px"></iframe>
                    </div>
                </div>
            </div>
        @endif


        <h5>Description</h5>
        {!! $blog->description !!}


        <h5>Date created</h5>
        {{$blog->created_at}}

    <livewire:blog.edit :type="$blog->type"  />
    <livewire:blog.publish  />
</div>
