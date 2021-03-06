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

Auth::routes();

Route::get('/greet', function () {
    return 'Hello world';
});

Route::get('/user_info', function (Request $request) {
    return Auth::user();
})->middleware('auth');

Route::get('/files', 'Api\DriveController@files');

Route::delete('/files/{fileId}', 'Api\DriveController@delete');

Route::post('/files', 'Api\DriveController@upload');

