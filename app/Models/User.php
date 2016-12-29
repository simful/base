<?php

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'user_type', 'settings'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules = [];

    protected $appends = ['avatar'];

    function getAvatarAttribute()
    {
        return '/img/default_avatar_female.jpg';
    }

    // get user settings.

    function getSetting($name, $defaultValue)
    {
        $settings = json_decode($this->settings);
        if (isset($settings->$name))
            return $settings->$name;
        else
            return $defaultValue;
    }

    function settings()
    {
        return Auth::user()->settings;
    }

    function saveSettings($settings)
    {
        Auth::user()->update(['settings' => json_encode($settings)]);
        return json_encode($settings);
    }

    function agent()
    {
        return $this->belongsTo('Agent');
    }
}
