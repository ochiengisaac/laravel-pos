<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AllAccountDataController;

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

Route::post('/login', 'AuthController@login');

Route::post('/register', 'AuthController@register');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', 'AuthController@me');
    Route::get('/analytics', 'AnalyticsController@index');
    Route::get('/allAccountsData', 'AllAccountDataController@index');
    Route::post('/postContact', 'AllAccountDataController@postContact');
    Route::post('/putContact', 'AllAccountDataController@putContact');
    Route::post('/postPurchase', 'AllAccountDataController@postPurchase');
    Route::post('/postSale', 'AllAccountDataController@postSale');
    Route::put('/putPurchase/{purchase_id}', 'AllAccountDataController@putPurchase');
    Route::put('/putSale', 'AllAccountDataController@putSale');
});

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    
    return $request->user();
});
*/
