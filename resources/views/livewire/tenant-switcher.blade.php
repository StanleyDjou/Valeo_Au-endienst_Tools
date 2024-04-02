<li class="dropdown d-none d-lg-block ">
    @if(!$user->isAdmin())
        @if($client)
            <a class="nav-link dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
                <img src="{{$client->logo()}}" alt="user-image" class="mr-2" height="30"> <span
                    class="align-middle">{{$client->name}} <i class="mdi mdi-chevron-down"></i> </span>
            </a>
        @endif
        <div class="dropdown-menu dropdown-lg">
            <div class="dropdown-item">
                <h6 class="font-16 m-0 mb-4">
                    <span>Organisation Switcher</span>
                </h6>
            </div>
            <div class="slimscroll noti-scroll">
                @foreach(auth()->user()->clients as $client)
                    <a href="javascript:void(0);" wire:click.prevent="set_current_tenant('{{$client->id}}')" class="dropdown-item notify-item">
                        <img src="{{$client->logo()}}" alt="user-image" class="mr-2" height="30"> <span
                            class="align-middle">{{$client->name}}</span>
                    </a>
                @endforeach
            </div>
        </div>

    @endif
</li>
