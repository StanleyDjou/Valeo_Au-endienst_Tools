<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SkillResource;
use App\Models\Images;
use App\Models\Skill;
use App\Models\UserService;
use App\Models\UserServiceSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{


    public $user;

    public function __construct()
    {
        $this->user = Auth::guard('api')->user();
    }

    /**
     * SKILLS
     * Endpoint to get all the skills present in the system, you may pass the parent id to have his sub skills
     *
     * @queryParam query nullable  to filter
     * @method GET
     */
    public function getSkills(Request $request)
    {
        $query = $request->get('query',"");
        return response([
            'success' => true,
            'skills' => SkillResource::collection(Skill::where('name', 'like', "%$query%")->get())
        ]);
    }

    /**
     * SERVICES
     * Endpoint to get all the skills present in the system, you may pass the parent id to have his sub skills
     *
     * @queryParam parent_id nullable  Parent Skill ID
     * @request /sub_skills?parent_is=PARENTID
     * @method GET
     */
    public function getSubSkills(Request $request)
    {
        $parent_id = $request->parent_id;
        if (isset($parent_id)) {
            return response([
                'success' => true,
                'skills' => SkillResource::collection(Skill::where('skill_id', $parent_id)->get())
            ]);
        }
        return response([
            'success' => true,
            'skills' => SkillResource::collection(Skill::whereNull('skill_id')->get())
        ]);
    }

    /**
     * SERVICES
     * Endpoint to get all the Services offered by the logged in user
     *
     *
     *@request /services
     *@method GET

     */

    public function getServices(){
        $services = $this->user->services;

        return response([
            'success' => true,
            'services' => ServiceResource::collection($services),
        ]);
    }

    /**
     * ADD SERVICE
     * Endpoint to add a service for the logged in user
     *
     * @queryParam title required  Service Title
     * @queryParam description required  Service Description
     *@request /services/add_service?title=TITLE&description=DESCRIPTION
     *@method POST

     */

    public function addService(Request $request){

        $validated = Validator::make($request->all(),[
            "title" => 'required',
            "description" => "required",
            "skills" => "required",
        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->first()
                ]);
        }

        $service = UserService::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $this->user->id,
            ]
            );

        for ($i = 0; $i < $request->images_count; $i++) {
            $service->images()->create(
                [
                    'image_path' => $request->file('image_' . $i)->store('images'),
                ]
            );
        }

         ;
        foreach (Skill::whereIn("name", json_decode($request->skills))->get() as $skill){
            UserServiceSkill::create([
                'user_service_id'=>$service->id,
                'skill_id'=>$skill->id
            ]);
        }


        return response([
            'success' => true,
            'message' => "Service added successfully",
        ]);
    }

    /**
     * ADD SERVICE IMAGE
     * Endpoint to add an image to the set of images for a particular service
     *
     * @queryParam image required|image  Service Image
     * @queryParam service_id required  Service ID
     *@request /services/add_image?image=FILE&service_id=SERVICEID
     *@method POST

     */
    public function addServiceImage(Request $request, $id){
        $validated = Validator::make($request->all(),[
            "image" => 'required|image',
        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->all()
                ]);
        }
        $service = UserService::find($id);
        $service->images()->create(
            [
                'image_path' => $request->image->store('images'),
            ]
        );
        return response([
            'success' => true,
            'message' => "Service updated successfully"
        ]);
    }

    /**
     * ADD SERVICE SKILL
     * Endpoint to add a skill to the set of skills for a particular service
     *
     * @queryParam skill_id required  Skill ID
     * @queryParam service_id required  Service ID
     *@request /services/add_skill?service_id=SERVICEID&skill_id=SKILLID
     *@method POST

     */
    public function addServiceSkill(Request $request, $id){
        $validated = Validator::make($request->all(),[
            "skill_id" => 'required',
            "service_id" => "required",
        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->all()
                ]);
        }

        $skill = new UserServiceSkill();
        $skill['skill_id'] = $request->skill_id;
        $skill['user_service_id'] = $id;

        $skill->save();
        return response([
            'success' => true,
            'message' => "Service updated successfully"
        ]);
        }

    /**
     * DELETE SERVICE
     * Endpoint to delete a service offered by the logged in user.
     *
     * @queryParam service_id required  Service ID
     *@request /services/delete_service?service_id=SERVICEID
     *@method POST
     */
    public function deleteService(Request $request, $id){

        $service = UserService::find($id);
        foreach($service->images as $image){
            try {
                unlink('storage/'.$image->image_path);
                $image->delete();
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        $service->delete();
        $services = $this->user->services();
        return response([
            'success' => true,
            'message' => "Service deleted successfully"
        ]);
    }
}
