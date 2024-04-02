<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegionResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Cities;
use App\Models\Regions;
use Illuminate\Http\Request;

class LocationController extends Controller
{
        /**
     *
     *@request /regions
     *@method GET

     */
    public function getRegions(){
        $regions = Regions::all();
        return response([
            'success' => true,
            'regions' => RegionResource::collection($regions)
        ]);
    }

        /**
     *

     *
     * @queryParam region_id required  Region ID
     *@request /cities?region_id=REGIONID
     *@method GET

     */

    public function getCities(Request $request){
        $validated = Validator::make($request->all(),[
            "region_id" => 'required',

        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->all()
                ]);
        }
        $region_id = $request->region_id;
        $cities = Cities::where('region_id', $region_id)->get();
        return response([
            'success' => true,
            'cities' => RegionResource::collection($cities)
        ]);
    }
}
