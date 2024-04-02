<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RequestResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\StatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public $user;

    public function __construct(){
        $this->user = Auth::guard('api')->user();
    }

    /**
     * GET REQUESTS
     * Endpoint to get  all requests sent by the current logged in user.
     *
     *@request /requests
     *@method GET

     */

    public function getRequests(Request $request)
    {
        $req = $this->user->requests();
        if ($request->status != "all") {
            $req = $req->whereStatus($request->status);
        }

        return response([
            'success' => true,
            'requests' => RequestResource::collection($req->get()),
        ]);
    }

    /**
     * ADD REQUEST
     * Endpoint to create a new request for a user
     *
     * @queryParam title required  Request Title
     * @queryParam description required  Request Description
     * @queryParam date date|after:now  Requests Desired Date Of Completion
     * @queryParam images nullable  Request's Array of Images
     *@request /requests/add_request?title=TITLE&description=DESCRIPTION
     *@method POST

     */
    public function addRequest(Request $request){
        $validated = Validator::make($request->all(), [
            "title" => 'required',
            "description" => "required",
            "date" => "date|after:now",
            "service_id" => "nullable",
            "skills" => "required",
        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->first()
                ]);
        }


        $req = \App\Models\Request::create([
            'user_id' => $this->user->id,
            'title' => $request->title,
            'description' => $request->description,
            'service_id' => $request->service_id,
            'skills' => $request->skills,
            'date' => $request->date,
            'status' => \App\Models\Request::STATUS_DRAFT,
        ]);

        for ($i = 0; $i < $request->images_count; $i++) {
            $req->images()->create(
                [
                    'image_path' => $request->file('image_' . $i)->store('images'),
                ]
            );
        }

        return response([
            'success' => true,
            'request' => new RequestResource($req),
        ]);

    }

    /**
     * Update REQUEST
     * Endpoint to update a request from a user
     *
     * @queryParam request_id required  Request ID
     * @queryParam title nullable  Request Title
     * @queryParam description nullable  Request Description
     * @queryParam date date|after:now  Requests Desired Date Of Completion
     * @queryParam images nullable  Request's Array of Images
     *@request /requests/update_request?request_id=REQUESTID&title=TITLE&description=DESCRIPTION
     *@method POST

     */
    public function updateRequest(Request $request){
        $validated = Validator::make($request->all(),[
            "request_id" => 'required',
            "date" => "date|after:now",

        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->first()
                ]);
        }

        $req = \App\Models\Request::find($request->request_id);

        if ($req->status != \App\Models\Request::STATUS_DRAFT){
                return response(['success'=>false,
                'message' => 'The request cannot be updated because it is not in draft'
            ]);
        }

        $req->update([
            'title' => isset($request->title)? $request->title : $req->title,
            'description' => isset($request->description)? $request->description : $req->description,
            'date' => isset($request->date)? $request->date : $req->date,
        ]);

        if(isset($request->images)){
            foreach($request->images as $image){
                $req->images()->create(
                    [
                        'image_path' => $image->store('images'),
                    ]
                    );
            }
        }

        return response([
            'success' => true,
            'request' => new RequestResource($req),
        ]);
    }

    /**
     * UPDATE REQUEST STATUS
     * Endpoint to update the status of a user's request
     *
     * @queryParam request_id required  Request ID
     * @queryParam status required New Request Status in ['pending', 'completed', 'cancelled']
     * @request /requests/update_status?request_id=REQUESTID&status=STATUS
     * @method POST
     */

    public function sendRequest(Request $request, $id)
    {
        $req = \App\Models\Request::find($id);


        if (in_array($req->status, \App\Models\Request::STATUS)) {
            $req->update([
                'status' => "pending"
            ]);

            $admins = User::where('admin', '1')->get();
            $link = route('requests.detail', $req);
            $details['greeting'] = 'Hi,';
            $details['subject'] = 'New Request from user';
            $details['body'] = "<p>you have a new request from $req->user->first_name   </p>
                                <p>Title :   $req->title </p>
                                <p>Description :   $req->description </p>
                            <p>Click <a href = '$link'>here</a> to know more</p>";
            try {
                Notification::send($admins, new StatusUpdated($details));
            } catch (\Exception $e) {

            }
            return response([
                'success' => true,
                'message' => "Request updated",
            ]);
        } else {
            return response([
                'success' => false,
                'message' => 'Status is not valid',
            ]);
        }

    }

    /**
     * DELETE REQUEST
     * Endpoint to delete a users request
     *
     * @queryParam request_id required  Request ID
     * @request /requests/delete_request?request_id=REQUESTID
     * @method POST
     */
    public function deleteRequest($id)
    {
        $req = \App\Models\Request::find($id);

        if (!in_array($req->status, [\App\Models\Request::STATUS_DRAFT, \App\Models\Request::STATUS_PENDING])) {
            return response([
                'success' => false,
                'message' => 'The request status does not permit deletion'
            ]);
        }

        foreach ($req->images as $image) {
            try {
                unlink('storage/' . $image->image_path);
                $image->delete();
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        $req->delete();
        $reqs = $this->user->requests;
        return response([
            'success' => true,
            'message' => 'The request has been deleted successfully'
        ]);
    }


    /**
     *find professionals
     * @method POST
     */
    public function search(Request $request)
    {
        $users = new User();

        $users = $users->where('role', "worker")->get();
        return response([ 'success' => true,'data'=>$request->all(), 'result' => \App\Http\Resources\ProfessionalResource::collection($users)], 200);
    }
}
