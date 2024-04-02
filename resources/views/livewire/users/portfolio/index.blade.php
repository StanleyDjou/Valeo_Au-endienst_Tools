<div>
    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Created On</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($portfolios as $k=>$portfolio)
                <tr wire:key="{{$k}}">
                    <td>{{$loop->index + 1}}</td>
                    <td>
                        {{$portfolio->title}}
                    </td>
                    <td>
                        {{$portfolio->created_at}}
                    </td>
                    <td>
                        <div class="button-list">
                            <a href="{{route('portfolio.detail', $portfolio)}}" class="btn btn-primary"><i
                                class="fa fa-eye"></i> </a>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" class=" text-center">No Portfolio Found</td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>
