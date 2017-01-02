<?php

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
	public $fillable = ['code', 'name', 'rate'];
	public $timestamps = false;
}
