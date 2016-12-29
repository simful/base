<?php

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $fillable = ['description', 'date',];
    public static $rules = [];

    function account() {
        return $this->belongsTo('Account');
    }

    function details() {
        return $this->hasMany('TransactionDetail');
    }
}
