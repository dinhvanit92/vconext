<?php

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

Route::post('/login', 'Api\AuthController@login');
Route::post('/register', 'Api\AuthController@register');
Route::get('/oauth/refreshToken', 'Api\OauthTokenController@refreshToken');
Route::delete('/logout', 'Api\AuthController@logout')->middleware('auth:api');

Route::group(['prefix' => 'admin'], function () {
    Route::apiResource('/users', 'Admin\UserController');
    Route::apiResource('/industries', 'Admin\IndustryController');
    Route::apiResource('/positions', 'Admin\PositionController');
});
