<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InterestResource;
use App\Http\Resources\ProfilePrompt as ProfilePromptResource;
use App\Http\Resources\UserPrompt;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfilePrompt;
use App\Models\UserProfilePrompt;
use App\Models\Image;
use App\Models\Interest;
use App\Models\User;
use App\Models\UserInterest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Hash;

class EditProfileController extends Controller
{

    public function getUserData(Request $request)
    {
        $user = Auth::guard('api')->user();

        if($request->user_id) {
            $user = User::find($request->user_id) ?? $user;
        }

        return response()->json([
            'success' => 200,
            'user' => new UserResource($user)
        ]);
    }


    public function updateBio(Request $request)
    {
        $user = Auth::guard('api')->user();

        $user->bio = $request->get('bio');
        $user->save();
        return response()->json([
            'success' => 200
        ]);
    }


    public function saveName(Request $request)
    {
        $user = Auth::guard('api')->user();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->save();

        return response()->json(['success' => 200]);
    }

    public function changePassword(Request $request)
    {
        $user = Auth::guard('api')->user();

        if(Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->get('new_password'));
            $user->save();
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' =>false,
                'message' => "Current password entered is incorrect."
            ]);
        }
    }

    public function saveAddress(Request $request)
    {
        $user = Auth::guard('api')->user();
        $user->state_id = $request->get('state_id');
        $user->city = $request->get('city');
        $user->save();

        return response()->json([
            'success' => 200
        ]);
    }



        /**
     *

     * ADD PROFILE IMAGE
     * 
     * Endpoint to add profile image
     * @queryParam profile required  User Profile Picture
     *@request /save_profile_image?profile=PROFILE
     *@method POST

     */
    public function saveProfileImage(Request $request)
    {
        $validated = Validator::make($request->all(),[
            "profile" => 'required',
        ]);

        if($validated->fails()){
            return response([
                'success' => false,
                'message'=> 'The profile field is required'
            ]);
        }
        $user = Auth::guard('api')->user();
        $old_image = $user->profile;
        if($old_image) {

                try{
                    unlink("storage/".$old_image);
                }catch ( \Exception $exception){

                }
        }

        $image = $request->profile;
        $user->update([
            'profile' =>  $image->store('profiles')
        ]);
        return response([
            'success' => true,
            'user' => new UserResource($user),
        ]);


    }

    public function changePhoneNumber(Request $request)
    {
        $validated = Validator::make($request->all(),[
            "phone" => "required",
        ]);

        if ($validated->fails()) {
            return response(['message' => $validated->errors()->all()], 400);
        };
        $user = $request->user();
        $user->phone_number = $request->phone;
        $user->save();

        return response([
            "message" => "Success",
        ], 201);
    }

    public function changeEmail(Request $request){
        $validated = Validator::make($request->all(),[
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        if ($validated->fails()) {
            return response(['message' => $validated->errors()->all()], 400);
        };
        $user = $request->user();
        $user->email = $request->email;
        $user->save();

        return response([
            "message" => "Success",
        ], 201);
    }

     public function updateNotificationSettings(Request $request){

            $user = $request->user();
            $user->setAttribute($request->action, $request->value);
            $user->save();

            return response([
                "message" => "Success",
            ], 201);
        }
}
