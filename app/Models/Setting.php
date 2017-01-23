<?php

class Setting
{
	static function all()
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
            'default_cash_account' => 1010,
            'default_sales_account' => 7010,
            'default_cogs_account' => 8010,
            'default_deposit_account' => 1030,
            'default_receivables_account' => 1020,
            'default_payables_account' => 3010,
        ];

        $agent = Agent::find(Auth::user()->agent_id);
        $settings = (object)(array_merge($default_settings, (array)json_decode($agent->settings)));

		return $settings;
	}

	static function get($name, $defaultValue = '')
	{
		$settings = static::all();
		return isset($settings->$name) ? $settings->$name : $defaultValue;
	}
}
