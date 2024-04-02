<?php

namespace App\Http\Controllers\API;

// use auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * LOGIN
     * Endpoint to login a user
     * 
     * @queryParam phone required  User Phone
     * @queryParam password required  User Password
     *@request /login?phone=PHONE&password=PASSWORD
     *@method POST

     */
    public function login(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validated->fails()) {
            return response(['success'=>false,'message' => $validated->errors()->first()]);
        }


        if (!(auth()->attempt($request->all()))) {
            return response([
                'message' => "User phone number or password not correct",
                "success" => false,
            ]);

        }

        $user = User::where(['phone' => $request->phone])->first();

        Auth::guard('api')->check($user);

        if (isset($user) && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('authToken')->accessToken;

            if ($token) {
                return response([
                    "message" => "User authentication successful",
                    'success' => true,
                    'user' => \App\Http\Resources\UserResource::make($user),
                    'token' => $token,
                ], 200);
            } else {
                return response([
                    'message' => "Server error,Please try again",
                    "success" => false
                ]);
            }
        }

    }



    /**
     *Register

     * REGISTER
     * Endpoint to register a new user to the system
     
     * @queryParam phone required  User Phone
     * @queryParam first_name nullable  User First name
     * @queryParam last_name nullable  User Last name
     * @queryParam email nullable  User Email
     * @queryParam password required  User Password
     *@request /register?phone=PHONE&password=PASSWORD
     *@method POST

     */
    public function register(Request $request)
    {

        $validated = Validator::make($request->all(),[
            "phone" => 'required',
            "email" => "nullable",
            "password" => 'required',
            "first_name"=> "required",
            "last_name" => "required",
        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->first()
                ]);
        };

        $result = User::where(['phone' => $request->phone])->first();

        if($result){
            return response([
                "message" => "Phone number already taken, Please try again with a different phone number",
                'success' => false,
            ]);
        }

        $user = User::create(
            [
            'first_name' => $request->first_name,
            'last_name'=> $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            ]);

        Auth::guard('api')->check($user);

        $token = $user->createToken('authToken')->accessToken;

       if ($token) {
            return response([
                "message" => "User created successfully",
                'success' => true,
                'user' => UserResource::make($user),
                'token' => $token

            ], 200);
        } else {
             return response([
                'message' => "Server error,Please try again",
                "success" => false,
            ]);
        }

    }

}
