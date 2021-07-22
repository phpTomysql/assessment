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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/invite','App\Http\Controllers\Api\UserController@invite');

Route::post('/accept-invite','App\Http\Controllers\Api\UserController@acceptInvite');

Route::post('/verify','App\Http\Controllers\Api\UserController@verify');

Route::post('/login','App\Http\Controllers\Api\UserController@login');

Route::middleware(['auth:sanctum'])->group(function () {

Route::post('/invite','App\Http\Controllers\Api\UserController@invite')->middleware('admin');

Route::post('/update-profile','App\Http\Controllers\Api\UserController@updateProfile');


});

