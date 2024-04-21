<div>
    <h4>User Details</h4>
    <div class="row mt-2">
        <div class="col-12 col-lg-4 ">
            <div class="row d-flex align-items-center py-4 px-2 bg-white rounded-lg shadow-sm mx-2">
                <div class=" col-12 col-md-4">
                        <img class="bg-white  signature-image" style="max-width:  100px"
                        src="{{ !isset($user->profile)?  asset('be_assets/images/Frame 75.png') : asset('storage/'.$user->profile) }}">
                </div>
                <div class="col-12 col-md-6">
                    <span>
                        <h4>{{$user->name}}</h4>

                    </span>
                </div>
                <div class="col-12 my-2">
                    <span>
                        <div class="d-flex align-items-center ">
                            <p class="font-weight-bold font-16 text-dark">Status</p>
                            <div class=" p-2 mx-2 rounded-lg badge badge-{{$user->status == '1' ? 'success' : 'processing'}}" style="margin-top: -5px">
                                {{$user->status == '1' ? 'Admin' : 'Worker'}}
                            </div>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">Email :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->email}}</p>
                        </div>
                        <div class="d-flex align-items-center ">
                            <p class="font-weight-bold font-16 text-dark">Phone :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->phone}}</p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">Joined On :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->created_at}}</p>
                        </div>
                    </span>
                </div>

            </div>
        </div>
        <div class="col-12 col-lg-8   py-4 px-2 bg-white rounded-lg shadow-sm">
            <div class="d-flex overflow-auto">
                @foreach ($menus as $menu)
                    <a href="{{route('user.detail', ['user' => $user, 'tab' => $loop->index])}}" class="hover-overlay text-dark">
                        <div class="px-4 py-1 d-flex align-items-center {{$tab == $loop->index? 'border-bottom  border-primary' : ''}} ">
                            <p class="font-weight-bold {{$tab == $loop->index? 'text-primary' : ''}} font-16 ">{{$menu}}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            @if ($tab == 0)
                <livewire:users.services.index :user="$user" />
            @endif

        </div>

        <div>

        </div>
    </div>
</div>
