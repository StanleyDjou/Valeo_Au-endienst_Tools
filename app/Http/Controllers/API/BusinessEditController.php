<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BusinessEditController extends Controller
{
    /**
     *

     *
     * BUSINESS UPDATE
     * Enpoint to update business information for a logged in user
     * 
     * @queryParam company required  Company Name
     * @queryParam address required  Company Address
     * @queryParam city_id required  Company City ID
     * @queryParam region_id required  Region ID
     * @queryParam website required  COmpany Website
     *@request /business_update?company=Company&address=ADDRESS&city_id=CITYID&region_id=REGIONID&website=WEBSITE
     *@method POST

     */
    public function business_update(Request $request){
        $validated = Validator::make($request->all(),[
            "company" => 'required',
            "address" => "required",
            "city_id" => 'required',
            "region_id"=> "required",
            "website" => "required",
        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->all()
                ]);
        } else{
           $user = Auth::guard('api')->user();

           if($user->role != 'worker'){
                return response([
                    'success' => false,
                    'message' => 'This user is a client so cannot have a company',
                ]);
           }
            $user->update([        
                "company" => $request->company,
                "address" => $request->address,
                "city_id" => $request->city_id,
                "region_id"=> $request->region_id,
                "website" => $request->website,
                ]
            );
            
            return response([
                'success' => true,
                'user' => new UserResource($user),
            ]);
        };
    }
}
