<div>
    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Role</th>
            </tr>
            </thead>
            <tbody>
            @forelse($trips as $k=>$trip)
                <tr wire:key="{{$k}}">
                    <td>{{$loop->index + 1}}</td>
                    <td>
                        <div class="d-flex">
                            {{$trip->trip->title}}
                        </div>
                    </td>
                    <td>
                        {{$trip->trip->location}}
                    </td>
                    <td>
                        {{$trip->trip->start_date}}
                    </td>
                    <td>{{$trip->trip->end_date}} </td>
                    <td> <div class="p-2 rounded badge badge-success ">{{$trip->trip->state}}</div> </td>
                    <td>{{$trip->role}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class=" text-center">No Trip Found</td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>
