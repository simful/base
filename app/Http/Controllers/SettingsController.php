<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Agent, Image, Setting;

class SettingsController extends Controller
{
    public function index($page = "main")
	{
        $settings = Setting::all();
        $settings_footer = true;
        return view('settings.' . $page, compact('settings', 'settings_footer'));
	}

	public function save(Request $request)
	{
        $agent = Agent::find(Auth::user()->agent_id);
        $settings = json_decode($agent->settings);

        if ( ! $settings) {
            $settings = [];
        }

        $agent->settings = json_encode((object)array_merge((array)$settings, $request->all()));
        $agent->save();

        return back()->with('message', 'Changes saved.');
	}

    function uploadLogo(Request $request)
    {
        // default values:
        $defaults = [
            'shape' => 'square'
        ];

        Image::make($request->file('logo'))
            ->resize(null, 512, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
            ->save(public_path('logo') . '/' . md5(Auth::user()->agent_id) . '.jpg');

        return redirect()->back();
    }
}
