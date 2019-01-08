<?php

use Illuminate\Http\Request;
use App\Ship;

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



Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'UserController@authenticate');
    Route::post('register', 'UserController@register');
    Route::post('logout', 'UserController@logout');
});

Route::group(['middleware' => ['jwt.verify']], function($router) {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('closed', 'DataController@closed');
	
	Route::get('ships', 'ShipController@index');
	Route::get('ships/{ship}', 'ShipController@get');
	Route::post('ships', 'ShipController@store');
	Route::put('ships/{ship}', 'ShipController@update');
	Route::delete('ships/{ship}', 'ShipController@delete');

	Route::get('dockSlots', 'DockSlotController@index');
	Route::get('dockSlots/{dockSlot}', 'DockSlotController@show');
	Route::post('dockSlots', 'DockSlotController@store');
	Route::put('dockSlots/{dockSlot}', 'DockSlotController@update');
	Route::delete('dockSlots/{dockSlot}', 'DockSlotController@delete');

	Route::get('shipTypes', 'ShipTypeController@index');
	Route::get('shipTypes/{shipType}', 'ShipTypeController@show');
	Route::post('shipTypes', 'ShipTypeController@store');
	Route::put('shipTypes/{shipType}', 'ShipTypeController@update');
	Route::delete('shipTypes/{shipType}', 'ShipTypeController@delete');
});
