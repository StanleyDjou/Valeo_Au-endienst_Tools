<div class="mt-5">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
            <h3>Constants</h3>
        </div>
    </div>
    <p class="sub-header">
        List of constants
    </p>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Value</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\Constant::all() as $k=>$constant)
                <tr wire:key="{{$k}}">
                    <td>{{$k+1}}</td>
                    <td>{{$constant->name}}</td>
                    <td>{{$constant->value}}</td>
                    <td>
                        <a href="#" wire:click.prevent="$emitTo('constant.edit','load',{{$constant}})" class="btn btn-default text-primary"><i class="fa fa-pen"></i> Edit</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>


    {{-- / Pagination --}}

    <livewire:constant.edit  />
</div>
