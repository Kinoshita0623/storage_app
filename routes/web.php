<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/{any}', function () {
    return view('layouts.app');
})->where('any', '.*');

//Route::get('/', 'DriveController@files')->name('home');

//Route::get('/files', 'DriveController@files')->name('files');

//Route::post('/files', 'DriveController@upload');

//Route::delete('files/{fileId}', 'DriveController@delete');
