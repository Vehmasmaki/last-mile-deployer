<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function all()
	{
		return App_settings::all();
	}

	public function show($id)
	{
		return App_settings::where('id', $id)->first();
	}

    public function create(Request $request)
    {
    	return App_settings::create($request->all());
    }

    public function update(Request $request, $setting)
    {
    	$App_settings = App_settings::findOrFail($setting);
        $App_settings->update($request->all());

       	return $App_settings;
    }

    public function delete(Request $request, $id)
    {
        App_settings::findOrFail($id)->delete();
        Server_credentials::where('server_id', $id)->delete();
        return 204;
    }
}
