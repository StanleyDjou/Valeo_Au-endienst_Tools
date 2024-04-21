<div>
    <div class="mt-3">
        <div class="clearfix">
            <div class="float-left mb-2">
                <img src="{{asset('be_assets')}}/images/valeo-logo.png" alt="" height="100">
            </div>
            <div class="float-right">
                <h2 class="m-0 d-print-none">{{ucfirst($trip->title)}}</h2>
            </div>
        </div>


        <div class="row">

            
            <div class="col-6">

                <div class="float-left mt-3">
                    <p><b> Description</b></p>
                    <p class="text-muted">{!!$trip->description!!} </p>
                </div>

            </div><!-- end col -->
            <div class="col-4 offset-2">
                <div class="mt-3 float-right">
                    <p><strong>Trip Start Date : </strong> {{$trip->start_date}}</p>
                    <p><strong>Trip End Date :</strong> {{$trip->end_date}}</p>
                    <p><strong>Trip Duration :</strong> {{$trip->days()}} Day{{$trip->days()>1? 's' : ''}}</p>
                    <p><strong>Trip State : </strong> <span class="badge badge-success">{{$trip->state}}</span></p>
                    <p><strong>Location : </strong> {{$trip->location}}</p>
                    <p><strong>Distance : </strong> {{$trip->distance}}Km</p>
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->
        <h4>Workers Assigned</h4>
       
            
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-centered mt-4">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($trip->workers as $worker)
                                    
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>
                                            <b>{{$worker->user->name}}</b> 
                                        </td>
                                        <td>{{ucfirst($worker->role)}}</td>
                                        <td>{{$worker->user->email}}</td>
                                        <td >{{$worker->user->phone}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <h4 class="my-4">Expenses</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-centered mt-4">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Quantity</th>
                            <th>Unit Cost (€)</th>
                            <th class="text-right">Total (€)</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{1}}</td>
                                <td>
                                    <b>Hotel Room</b> <br>
                                </td>
                                <td>{{$trip->workers->count()}}</td>
                                <td>{{$trip->hotel_price}}</td>
                                <td class="text-right">{{$trip->hotel_total()}}</td>
                            </tr>
                            <tr>
                                <td>{{2}}</td>
                                <td>
                                    <b>Transportation</b> <br>
                                </td>
                                <td>{{$trip->workers->count()}}</td>
                                <td>{{\App\Models\Constant::find(2)->value}}l /100Km</td>
                                <td class="text-right">{{$trip->transport_total()}}</td>
                            </tr>
                            <tr>
                                <td>{{3}}</td>
                                <td>
                                    <b>Food</b> <br>
                                </td>
                                <td>{{$trip->workers->count()}}</td>
                                <td>{{\App\Models\Constant::find(3)->value}}</td>
                                <td class="text-right">{{$trip->food_total()}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="clearfix pt-4">
                    <h6 class="text-muted">Notes:</h6>

                    <small>
                        All Estimations are base on data entered during the trip creation and depends on the total number of workers assigned to the trip
                    </small>
                </div>

            </div>
            <div class="col-6">
                <div class="float-right">
{{--                    <p><b>Sub-total:</b> $4120.00</p>--}}
                    <h3>{{$trip->hotel_total() + $trip->transport_total() + $trip->food_total()}} €</h3>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>



        <div class="mt-4 mb-4">
            <div class="text-right d-print-none">
                <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light mr-1"><i
                        class="fa fa-print mr-1"></i> Print</a>
            </div>


        </div>
    </div>
</div>
