<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SclassController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\StudentController;



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


Route::ApiResource('/class','App\Http\Controllers\Api\SclassController');
Route::ApiResource('/subject','App\Http\Controllers\Api\SubjectController');
Route::ApiResource('/section','App\Http\Controllers\Api\SectionController');
Route::ApiResource('/student','App\Http\Controllers\Api\StudentController');


/*****************    JWT AUTHENTICATION    ***********************  */
Route::group([
    'prefix' => 'auth'

], function () {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::post('register','App\Http\Controllers\AuthController@register');

});