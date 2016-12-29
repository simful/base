<?php

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $fillable = ['name', 'address', 'city', 'state', 'country', 'phone', 'email', 'website', 'type'];

    function invoices() {
        return $this->hasMany('Invoice');
    }

    protected $appends = ['avatar'];

    function getAvatarAttribute()
    {
        if (App::environment('local'))
            return '/img/default_avatar_female.jpg';
        else
            return '//www.gravatar.com/avatar/' . md5(strtolower($this->email));
    }
}
