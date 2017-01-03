<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Agent;

class SettingsController extends Controller
{
    public function index($page = "main")
	{
        // fallback settings
        $default_settings = [
            'name' => 'Company Name',
            'address' => 'Company Address',
            'email' => 'admin@company.com',
            'phone' => '123456789',
            'city' => 'Jakarta',
            'state' => 'Jakarta',
            'country' => 'Indonesia',
            'website' => 'companyname.com',
            'locale' => 'id_ID',
            'default_currency' => 'Rp ',
            'date_format' => '',
            'time_format' => '',
            'logo_position' => 'left',
            'logo_size' => 64,
            'header_content' => '',
            'footer_content' => '',
            'mail_provider' => 'none',
            'mail_address' => '',
            'mail_password' => '',
            'smtp_server' => '',
            'smtp_port' => '',
            'connection_type' => 'tls',
        ];

        $agent = Agent::find(Auth::user()->agent_id);
        $settings = (object)(array_merge($default_settings, (array)json_decode($agent->settings)));

        return view('settings.' . $page, compact('settings'));
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
}
