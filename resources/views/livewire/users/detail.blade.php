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
                        <h4>{{$user->first_name}}</h4>
                        <li class="text-primary font-weight-bold">{{ucfirst($user->role)}}</li>
                        <div class="d-flex mt-2">
                            <button class="btn border border-primary rounded  text-primary">
                                Edit
                            </button>
                            <button class="mx-1 btn btn-warning ">
                                Suspend
                            </button>
                            <button class="btn btn-danger ms-2">
                                Delete
                            </button>
                        </div>

                    </span>
                </div>
                <div class="col-12 my-2">
                    <span>
                        <div class="d-flex align-items-center ">
                            <p class="font-weight-bold font-16 text-dark">Status</p>
                            <div class=" p-2 mx-2 rounded-lg badge badge-{{$user->status == '1' ? 'success' : 'processing'}}" style="margin-top: -5px">
                                {{$user->status == '1' ? 'Active' : 'Inactive'}}
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
                            <p class="font-weight-bold font-16 text-dark">Address :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->address}}</p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">Website :</p>
                            <p class="font-16 mx-2 text-dark">{{$user->website}}</p>
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
                <livewire:users.services.index :user_id="$user_id" />
            @endif

            @if ($tab==1)
                <livewire:users.portfolio.index :user_id="$user_id" />
            @endif
        </div>

        <div>

        </div>
    </div>
</div>
