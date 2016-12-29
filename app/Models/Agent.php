<?php

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
	public $fillable = ['name', 'address', 'city', 'state', 'country', 'phone', 'email', 'website', 'max_users', 'package', 'billing_cycle', 'settings'];
    public static $rules = ['name' => 'required'];
	protected $appends = ['logo'];

	function getLogoAttribute()
	{
		return '/logo/' . md5($this->id) . '.jpg';
	}

	function invoices() {
		return $this->hasMany('Invoice');
	}

	function accounts() {
		return $this->hasMany('Account');
	}

	function companies() {
		return $this->hasMany('Company');
	}

	function customers() {
		return $this->hasMany('Customer');
	}

	function transactions() {
		return $this->hasMany('Transaction');
	}

	function users() {
		return $this->hasMany('User');
	}
}
