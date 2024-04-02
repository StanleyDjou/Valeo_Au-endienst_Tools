<div>
    <div class="mt-5">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
                <h3 class="text-capitalize">{{isset($skill)? $skill->name : ''}} Skills</h3>

                @if (isset($skill_id))
                    <a href="#"  wire:click.prevent="$emitTo('skills.add-sub','load', {{$skill}})" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                        <div>
                            <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                            Add Sub Skill
                        </div>
                    </a>
                @endif
                @if (!isset($skill_id))
                    <a href="#"  wire:click.prevent="$emitTo('skill.edit','load')" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                        <div>
                            <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                            Add Skill
                        </div>
                    </a>
                @endif
            </div>
            <div class="col-md-6 col-lg-4">
                <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm" placeholder="Type to Search">
            </div>
        </div>
        <p class="sub-header">
            List of  Skills
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
                @foreach($skills as $k=>$skill)
                    <tr wire:key="{{$k}}">
                        <td>{{$k+1}}</td>
                        <td>
                            <div class="d-flex">
                                <img src="{{$skill->coverImage()}}" alt="" width="30px">
                                <h6 class="m-2">{{$skill->name}}</h6>
                            </div>
                        </td>
                        <td>
                            @if(!isset($skill->skill_id))
                                <a href="{{route('skills',['skill'=>$skill])}}" class="btn btn-default text-secondary"><i class="fa fa-pen"></i> Sub Skills</a>
                            @endif

                            <a href="#" wire:click.prevent="$emitTo('skills.edit','load',{{$skill}})" class="btn btn-default text-success"><i class="fa fa-pen"></i> Edit</a>
                            <a href="#" wire:click.prevent="$emitTo('skills.delete','load',{{$skill}})" class="btn btn-default text-danger"><i class="fa fa-trash"></i> Delete</a>
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

        <livewire:skills.edit />
        <livewire:skills.add-sub  />

        <livewire:skills.delete  />
    </div>
</div>

