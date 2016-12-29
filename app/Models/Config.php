<?php

class UserConfig
{
	public $user_setting_defaults = [
		'per_page_display' => 20,
		'theme' => 'sky'
	];

	public $agent_setting_defaults = [
		'timezone' => 'Asia/Jakarta',
		'currency' => 'IDR',
		'invoice_header' => '',
		'invoice_footer' => '',
	];

	static function get($name, $default_value = null)
	{
		$agent_settings = json_decode(Auth::user()->agent->settings);
		return isset($agent_settings->$name) ? $agent_settings->$name : $default_value;
	}
}
