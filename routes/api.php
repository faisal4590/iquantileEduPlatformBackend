<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("login","IquantileBackendServiceController@login");
Route::post("add_user","IquantileBackendServiceController@add_user");
Route::post("insert_videos","IquantileBackendServiceController@insert_videos");
Route::post("video_lists","IquantileBackendServiceController@video_lists");
Route::post("get_single_video","IquantileBackendServiceController@get_single_video");
Route::post("add_comment","IquantileBackendServiceController@add_comment");
Route::post("get_video_comment","IquantileBackendServiceController@get_video_comment");


