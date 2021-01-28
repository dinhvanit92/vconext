<?php

use App\Http\Controllers\Admin\PositionController;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/********************************API - PAGE LOGIN LOGOUT ********************************** */

Route::post('/login', 'Api\AuthController@login');
Route::post('/register', 'Api\AuthController@register');
Route::get('/oauth/refreshToken', 'Api\OauthTokenController@refreshToken');
Route::delete('/logout', 'Api\AuthController@logout')->middleware('auth:api');


/*API - PAGE PROFILE */

Route::group(['middleware' => 'auth:api', 'scope:view-profile'], function () {
    Route::apiResource('/profile', 'UserController');
});

/*API - PAGE HOME*/

Route::get('position', 'PositionController@getPosition');

Route::get('industry', 'IndustryController@getIndustry');

Route::get('getuser', 'RandomUserController@getUser');

Route::get('getexplore', 'ExploreController@getExplore');


/*API - PAGE EVENT */

Route::get('upcoming-event', 'EventController@getUpcomingEvent');

Route::get('past-event', 'EventController@getpastEvent');

/********************************API - PAGE VOUCHERS ********************************** */


/********************************API - PAGE WORKPLACES ********************************** */


/********************************API - PAGE CONTACT ********************************** */


/********************************API ADMIN ********************************** */

Route::group(['prefix' => 'admin'], function () {
    Route::apiResource('/users', 'Admin\UserController');
    Route::apiResource('/industries', 'Admin\IndustryController');
    Route::apiResource('/positions', 'Admin\PositionController');
    Route::apiResource('/explore', 'Admin\ExploreController');
    Route::apiResource('/zone', 'Admin\ZoneController');
    Route::apiResource('/event', 'Admin\EventController');
});
