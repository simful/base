<?php

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public $fillable = ['name', 'buy_price', 'sell_price', 'description', 'is_active'];
	public $appends = ['picture'];
	public $casts = [
		'is_active' => 'boolean'
	];

	public function getPictureAttribute()
	{
		return url('/img/upload_icon.png');
	}
}