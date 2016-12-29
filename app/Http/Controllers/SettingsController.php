<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Agent;

class SettingsController extends Controller
{
    public function index($page = "main")
	{
        $agent = Agent::find(Auth::user()->agent_id);
        $settings = json_decode($agent->settings);
		return view('settings.' . $page, compact('settings'));
	}

	public function save()
	{
        $agent = Agent::find(Auth::user()->agent_id);
        $settings = json_decode($agent->settings);

        $agent->settings = $settings + $request->all();
        $agent->save();

        return back()->withErrors();
	}
}
