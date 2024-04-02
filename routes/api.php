<?php

use App\Http\Controllers\API\EditProfileController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\PortfolioController;
use App\Http\Controllers\API\RequestController;
use App\Http\Controllers\API\SkillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'API'], function () {
// login user
    Route::post('login', [AuthController::class, "login"]);
// register user

    Route::post('register', [AuthController::class, "register"]);
    Route::get('cities', [LocationController::class, "getCities"]);
    Route::get('regions', [LocationController::class, "getRegions"]);
    Route::get('skills', [SkillController::class, "getSkills"]);
    Route::get('sub_skills', [SkillController::class, "getSubSkills"]);
    Route::post('search', [RequestController::class, "search"]);

    Route::middleware('auth:api')->group(function () {
        // update user profile data
        Route::post('profile_update', [ProfileController::class, 'update']);
        Route::get('profile', [ProfileController::class, 'show']);
        Route::post('save_skills', [ProfileController::class, 'saveSkills']);
    });


    Route::group(['middleware' => ['auth:api']], function () {

        Route::group(['prefix' => 'services'], function () {
            Route::get('', [SkillController::class, 'getServices']);
            Route::post('add_service', [SkillController::class, 'addService']);
            Route::post('add_image/{id}', [SkillController::class, 'addServiceImage']);
            Route::post('add_skill/{id}', [SkillController::class, 'addServiceSkill']);
            Route::post('delete_service/{id}', [SkillController::class, 'deleteService']);
        });

        Route::group(['prefix' => 'portfolio'], function () {
            Route::get('', [PortfolioController::class, 'getPortfolios']);
            Route::post('save_portfolio', [PortfolioController::class, 'addPortfolio']);
            Route::post('add_image', [PortfolioController::class, 'addImage']);
            Route::post('remove_image', [PortfolioController::class, 'removeImage']);
            Route::post('delete_portfolio/{id}', [PortfolioController::class, 'deletePortfolio']);
        });

        Route::group(['prefix' => 'requests'], function () {
            Route::get('', [RequestController::class, 'getRequests']);
            Route::post('add_request', [RequestController::class, 'addRequest']);
            Route::post('update_request/{id}', [RequestController::class, 'updateRequest']);
            Route::post('delete_request/{id}', [RequestController::class, 'deleteRequest']);
            Route::post('send_request/{id}', [RequestController::class, 'sendRequest']);
        });

        Route::group(['prefix' => 'profile'], function () {
            Route::get('', [ProfileController::class, 'show']);
            Route::get('change_password', [EditProfileController::class,'changePassword']);
            Route::post('business_update', [\App\Http\Controllers\API\BusinessEditController::class,'business_update']);
            Route::post('save_profile_image', [EditProfileController::class, 'saveProfileImage']);

        });


    });
});
