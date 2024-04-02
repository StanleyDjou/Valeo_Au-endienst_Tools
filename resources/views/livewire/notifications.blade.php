<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
       aria-expanded="false">
        <i class="mdi mdi-bell text-white noti-icon"></i>
        {{--                    <span class="badge badge-danger rounded-circle noti-icon-badge">4</span>--}}
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-lg">
        <div class="dropdown-item noti-title">
            <h5 class="font-16 m-0">
                            <span class="float-right">
                            </span>Notification
            </h5>
        </div>
        <div class="slimscroll noti-scroll">
            @foreach(auth()->user()->notifications as $notification)
                <a href="javascript:void(0);" class="dropdown-item notify-item" wire:click.prevent="mark_as_read({{$notification}})">
                    <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                    <p class="notify-details">{{ $notification->data['title'] ?? ""}}<small class="text-muted">{{$notification->created_at->diffForHumans()}}</small></p>
                    <p class="notify-details">{{ strip_tags($notification->data['content'] )?? ""}}</p>
                </a>
            @endforeach

        </div>
    </div>
</li>
