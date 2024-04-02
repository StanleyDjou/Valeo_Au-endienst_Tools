<div class="mt-5">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
            <h3 class="text-capitalize">{{$type}}</h3>
            <a href="#"  wire:click.prevent="$emitTo('blog.edit','load')" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                Add {{$type}} blog
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm" placeholder="Type to Search">
        </div>
    </div>
    <p class="sub-header">
        List of {{$type}}
    </p>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Created At</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($blogs as $k=>$blog)
                <tr wire:key="{{$k}}">
                    <td>{{$loop->index + 1}}</td>
                    <td><a href="{{route('blog.detail', $blog)}}" class="text-primary">{{$blog->title}}</a></td>
                    <td>{{$blog->category->name}} </td>
                    <td><div class="badge {{$blog->status == 'draft'? 'badge-draft' : 'badge-success'}}">
                        {{ucfirst($blog->status)}} </div></td>
                    <td>{{$blog->created_at->format('d M Y')}}</td>
                    <td>
                        <a href="#" wire:click.prevent="$emitTo('blog.publish','load',{{$blog}})"
                        class="btn btn-default text-primary"><i class="fas fa-refresh"></i>  {{$blog->status==="published"?"un-Publish":"Publish"}}</a>
                        <a href="{{route('blog.detail', $blog)}}" class="btn btn-default text-secondary"><i
                                class="fa fa-eye"></i> View</a>
                        <a href="#" wire:click.prevent="$emitTo('blog.edit','load',{{$blog}})"
                           class="btn btn-default text-success"><i class="fa fa-pen"></i> Edit</a>
                        <a href="#" wire:click.prevent="$emitTo('blog.delete','load',{{$blog}})"
                           class="btn btn-default text-danger"><i class="fa fa-trash"></i> Delete</a>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($this->rows->count())
        <div class="mt-5">
            {{ $this->rows->links() }}
        </div>
    @endif
    {{-- / Pagination --}}

    <livewire:blog.edit :type="$type"  />
    <livewire:blog.delete  />
    <livewire:blog.publish  />
</div>

