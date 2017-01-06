<?php

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
	public $connection = 'tenant';
	public $fillable = ['code', 'name', 'rate'];
	public $timestamps = false;
}
