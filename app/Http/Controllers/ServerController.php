<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use App\Server_credentials;

class ServerController extends Controller
{

	public function all()
	{
		return Server::with('credentials')->get();
	}

	public function show($id)
	{
		return Server::where('id', $id)->with('credentials')->first();
	}

    public function create(Request $request)
    {
    	return Server::create($request->all());
    }

    public function update(Request $request, $id)
    {
    	$server = Server::findOrFail($id);
        $server->update($request->all());

       	return $server;
    }

    public function delete(Request $request, $id)
    {
        Server::findOrFail($id)->delete();
        Server_credentials::where('server_id', $id)->delete();
        return 204;
    }

    public function credentialsCreate(Request $request)
    {
    	return Server_credentials::create($request->all());
    }

    public function credentialsUpdate(Request $request, $id)
    {
    	$server = Server_credentials::findOrFail($id);
        $server->update($request->all());

       	return $server;
    }

    public function credentialsDelete(Request $request, $id)
    {
        $server = Server_credentials::findOrFail($id)->delete();
        return 204;
    }
}
