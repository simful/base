<?php

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	public $connection = 'tenant';
	public $fillable = ['name', 'address', 'city', 'state', 'country', 'phone', 'email', 'website',
		'is_customer', 'is_supplier', 'is_company'];
	public static $rules = ['name' => 'required'];

	protected $appends = ['avatar'];

    function getAvatarAttribute()
    {
        if (App::environment('local'))
            return '/img/default-avatar-female.png';
        else
            return '//www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
    }

	function invoices()
	{
		return $this->hasMany(Invoice::class, 'customer_id');
	}
}
