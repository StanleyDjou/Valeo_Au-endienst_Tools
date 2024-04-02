<div>
    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Started On</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($services as $k=>$service)
                <tr wire:key="{{$k}}">
                    <td>{{$loop->index + 1}}</td>
                    <td>
                        {{$service->title}}
                    </td>
                    <td>
                        {{$service->created_at}}
                    </td>
                    <td>
                        <div class="button-list">
                            <a href="{{route('service.detail', $service)}}" class="btn btn-primary"><i
                                class="fa fa-eye"></i> </a>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" class=" text-center">No Service Found</td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>
