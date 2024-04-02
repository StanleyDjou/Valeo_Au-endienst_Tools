<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioResource;
use App\Models\Images;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    public $user;

    public function __construct(){
        $this->user = Auth::guard('api')->user();
    }

    /**
     * GET PORTFOLIOS
     * Endpoint to get  all portfolios of the current logged in user.
     *
     *@request /portfolio
     *@method GET

     */

    public function getPortfolios(Request $request){
        $portfolios = $this->user->portfolios;

        return response([
            'success' => true,
            'portfolios' => PortfolioResource::collection($portfolios),
        ]);
    }

    /**
     * SAVE PORTFOLIO
     * Endpoint to create a new PORTFOLIO for a user
     *
     * @queryParam title required  Portfolio Title
     * @queryParam description nullable  Portfolio Description
     * @queryParam images nullable  Portfolios's Array of Images
     *@request /portfolio/save_portfolio?title=TITLE&description=DESCRIPTION
     *@method POST

     */
    public function addPortfolio(Request $request){
        $validated = Validator::make($request->all(),[
            "title" => 'required',
            "description" => 'required',
            "service" =>  'required',
        ]);

        if ($validated->fails()) {
            return response(['success'=>false,
                'message' => $validated->errors()->first()
            ]);
        }


        $portfolio = Portfolio::create([
            'user_id' => $this->user->id,
            'service_id' => $request->service,
            'title' => $request->title,
            'description' => $request->description,
        ]);


        for ($i = 0; $i < $request->images_count; $i++) {
            $portfolio->images()->create(
                [
                    'image_path' => $request->file('image_' . $i)->store('images'),
                ]
            );
        }


        return response([
            'success' => true,
            'message' => "Portfolio created successfully"
        ]);

    }

    /**
     * ADD IMAGE
     *
     * Endpoint to add image to portfolio
     *
     * @queryParam portfolio_id required  Portfolio ID
     * @queryParam image required  Portfolio Image
     *@request /portfolio/add_image?portfolio_id=PORTFOLIOID&image=IMAGE
     *@method POST

     */

     public function addImage(Request $request){
        $validated = Validator::make($request->all(),[
            "image" => 'required',
            "portfolio_id" => "required",
        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->all()
                ]);
        }

        $portfolio = Portfolio::find($request->portfolio_id);
        $portfolio->images()->create([
            'image_path' => $request->image->store('images'),
            ]
        );

        return response([
            'success' => true,
            'portfolio' => new PortfolioResource($portfolio)
        ]);
     }

    /**
     * REMOVE IMAGE
     *
     * Endpoint to remove image to portfolio
     *
     * @queryParam image_id required  Image ID
     *@request /portfolio/remove_image?image_id=IMAGEID
     *@method POST

     */

     public function removeImage(Request $request){
        $validated = Validator::make($request->all(),[
            "image_id" => 'required',
        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->all()
                ]);
        }


        $image = Images::find($request->image_id);
        $portfolio = Portfolio::find($image->imageable_id);
        try {
            unlink('storage/'.$image->image_path);
            $image->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }

        $image->delete();

        return response([
            'success' => true,
            'portfolio' => new PortfolioResource($portfolio)
        ]);
     }


    /**
     * DELETE PORTFOLIO
     * Endpoint to delete a users portfolio
     *
     * @queryParam portfolio_id required  Portfolio ID
     *@request /portfolio_id/delete_portfolio?portfolio_id=PORTFOLIOID
     *@method POST

     */
    public function deletePortfolio(Request $request, $id){

        $portfolio = Portfolio::find($id);

        foreach($portfolio->images as $image){
            try {
                unlink('storage/'.$image->image_path);
                $image->delete();
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        $portfolio->delete();
        return response([
            'success' => true,
            'message' => "Portfolio deleted successfully"
        ]);
    }
}
