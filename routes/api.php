<?php

use Illuminate\Http\Request;
use App\User;
use App\Server;
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

// Server routes
Route::get('servers', 'ServerController@all');
Route::get('servers/{id}', 'ServerController@show');
Route::post('servers', 'ServerController@create');
Route::put('servers/{id}', 'ServerController@update');
Route::delete('servers/{id}', 'ServerController@delete');

// Server credential routes
Route::post('servers/credentials', 'ServerController@credentialsCreate');
Route::put('servers/credentials/{id}', 'ServerController@credentialsUpdate');
Route::delete('servers/credentials/{id}', 'ServerController@credentialsDelete');

// App settings routes
Route::get('settings', 'SettingsController@all');
Route::get('settings/{id}', 'SettingsController@show');
Route::post('settings', 'SettingsController@create');
Route::put('settings/{id}', 'SettingsController@update');
Route::delete('settings/{id}', 'SettingsController@delete');

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});
