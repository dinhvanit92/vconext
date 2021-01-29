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

Route::get('position', 'PositionController@getPosition')->middleware('admin:api');

Route::get('industry', 'IndustryController@getIndustry');

Route::get('getuser', 'RandomUserController@getUser');

Route::get('getexplore', 'ExploreController@getExplore');


/*API - PAGE EVENT */

Route::get('upcoming-event', 'EventController@getUpcomingEvent');

Route::get('past-event', 'EventController@getpastEvent');

/*PI - PAGE VOUCHERS  */

Route::get('getvoucher', 'VoucherController@getVoucher');

Route::get('getfeaturevoucher', 'VoucherController@getFeatureVoucher');

/********************************API - PAGE WORKPLACES ********************************** */

Route::get('getworkplace', 'WorkplaceController@getWorkplace');
Route::get('mapsworkplace', 'MapController@getMapWorkplace');


/********************************API - PAGE CONTACT ********************************** */

Route::post('contact', 'ContactController@index');
Route::get('maps', 'MapController@getMap');


/********************************API ADMIN ********************************** */

Route::group(['prefix' => 'admin', 'middleware' => 'auth:api'], function () {
    Route::apiResource('/users', 'Admin\UserController')->middleware('admin');
    Route::apiResource('/industries', 'Admin\IndustryController')->middleware('admin');
    Route::apiResource('/positions', 'Admin\PositionController')->middleware('admin');
    Route::apiResource('/explore', 'Admin\ExploreController')->middleware('admin');
    Route::apiResource('/zone', 'Admin\ZoneController')->middleware('admin');
    Route::apiResource('/event', 'Admin\EventController')->middleware('admin');
    Route::apiResource('/voucher', 'Admin\VoucherController')->middleware('admin');
    Route::apiResource('/workplace', 'Admin\WorkplaceController')->middleware('admin');
    Route::apiResource('/maps', 'Admin\MapsController')->middleware('admin');
});
