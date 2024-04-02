<div>
    <div class="mt-5">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
                <h3 class="text-capitalize">{{$type}} Categories</h3>

                @if (isset($category_id))
                    <a href="#"  wire:click.prevent="$emitTo('categories.add-sub','load', {{$category}})" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                        <div>
                            <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                            Add Sub Categories
                        </div>
                    </a>
                @endif
                @if (!isset($category_id))
                    <a href="#"  wire:click.prevent="$emitTo('categories.edit','load')" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                        <div>
                            <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                            Add Categories
                        </div>
                    </a>
                @endif
            </div>
            <div class="col-md-6 col-lg-4">
                <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm" placeholder="Type to Search">
            </div>
        </div>
        <p class="sub-header">
            List of  categories
        </p>

        <div class="table-responsive">
            <table class="table table-bordered m-0">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $k=>$category)
                    <tr wire:key="{{$k}}">
                        <td>{{$k+1}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            @if ($category->type == 'product' && !isset($category->parent_id))
                                <a href="{{route('categories',['category'=>$category])}}" class="btn btn-default text-secondary"><i class="fa fa-pen"></i> Sub Categories</a>
                            @endif

                            <a href="#" wire:click.prevent="$emitTo('categories.edit','load',{{$category}})" class="btn btn-default text-success"><i class="fa fa-pen"></i> Edit</a>
                            <a href="#" wire:click.prevent="$emitTo('categories.delete','load',{{$category}})" class="btn btn-default text-danger"><i class="fa fa-trash"></i> Delete</a>
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

        <livewire:categories.edit :type="$type" />
        <livewire:categories.add-sub  />

        <livewire:categories.delete  />
    </div>
</div>
