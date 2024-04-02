<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\UserService;
use App\Models\UserServiceSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    /**
     *Get profile of authenticated user
     * @method GET
     */
    public function show(Request $request)
    {


        $user = $request->user();
        return response(['user' => new UserResource($user), 'success' => true], 200);
    }

    /**
     *Update users profile
     *
     * @queryParam first_name nullable  User First name
     * @queryParam last_name nullable  User Last name
     * @method POST
     */

    public function update(Request $request)
    {
        $validated = Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "required",
            'role' => "required",
            'company' => 'required_if:role,worker',
            'photo' => "nullable|file",
            'address' => 'required_if:role,worker',
            'region' => 'required_if:role,worker',
            'city' => 'required_if:role,worker',
            'website' => 'nullable|url',
            'bio' => 'required_if:role,worker',
        ]);

        if ($validated->fails()) {
            return response(['success' => false,
                'message' => $validated->errors()->first()
            ]);
        };

        $data = $request->all();
        $data['city_id'] = $data['city'];
        $data['region_id'] = $data['region'];

        if (isset($request->photo)) {
            $data['profile'] = $request->photo->store('profiles');
        }

        unset($data['type']);

        $user = $request->user();
        $user->update($data);
        $user->refresh();
        return response()->json([
            'user' => UserResource::make($user),
            'message' => 'Profile Updated Successfully',
            'success' => true
        ], 200);
    }


    public function notifications(Request $request)
    {
        return response()->json([
            'success' => '200',
            'message' => "",
            'notifications' => Notification::collection($request->user()->notifications)
        ]);
    }

    public function updateToken(Request $request)
    {
        $user = Auth::guard('api')->user();

        if(!$user) {
            return response()->json([
                'success' => 300,
                'message' => 'Invalid user'
            ]);
        }
        $user->fcm_token = $request->token;
        $user->save();

        return response()->json(['status' => 200]);
    }


    public function saveSkills(Request $request)
    {
        $user = Auth::guard('api')->user();
        $skills = json_decode($request->skills);

        $userService = UserService::create([
            'user_id'=>$user->id,
            'title'=>$skills[0]->name,
            'description'=>$skills[0]->name,
        ]);

        foreach ($skills as $skill){
            UserServiceSkill::create([
                'user_service_id'=>$userService->id,
                'skill_id'=>$skill->id
            ]);
        }

        return response()->json(['success' => true,'message'=>"Success"]);
    }
}
