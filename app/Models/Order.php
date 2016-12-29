<?php

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = ['id', 'name', 'account_group_id'];
    public static $rules = ['name' => 'required'];
}
