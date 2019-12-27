<?php

use Illuminate\Http\Request;
use App\User;
use App\Server;
use App\Http\Resources\Server as ServerResource;
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

Route::get('/gettoken', function () {
	$user = User::find(1);
	return $user->createToken('primary_token')->accessToken;;
});

Route::get('servers', 'ServerController@all');
Route::get('servers/{id}', 'ServerController@show');
Route::post('servers', 'ServerController@create');
Route::put('servers/{id}', 'ServerController@update');
Route::delete('servers/{id}', 'ServerController@delete');


Route::post('servers/credentials', 'ServerController@credentialsCreate');
Route::put('servers/credentials/{id}', 'ServerController@credentialsUpdate');
Route::delete('servers/credentials/{id}', 'ServerController@credentialsDelete');


Route::get('/server/{id}', function ($id) {
	return new ServerResource(Server::where('id', $id)->with('options')->first());
})->middleware('auth:api');

Route::get('/server', function () {
	return new ServerResource(Server::with('options')->get());
})->middleware('auth:api');

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});
