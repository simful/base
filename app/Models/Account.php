<?php

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $connection = 'tenant';
    public $fillable = ['id', 'name', 'account_group_id'];
    public static $rules = ['name' => 'required'];

    function transactions()
    {
        return $this->hasMany('TransactionDetail');
    }

    function group()
    {
        return $this->belongsTo('AccountGroup', 'account_group_id');
    }
}
