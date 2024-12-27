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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::group([
    'prefix' => 'v1',
], function() {
    Route::group([
        'prefix' => 'damarila',
        'middleware' => ['auth.mobile']
    ], function() {
        Route::get('ar', '\App\Http\Controllers\Api\v1\DamarilaController@getAR');

    });
    Route::group([
        'prefix' => 'gtr'
    ], function() {
        Route::any('test', '\App\Http\Controllers\Test\TestController@get');
    });
});
//