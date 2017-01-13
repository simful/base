<?php

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public $connection = 'tenant';
	public $fillable = ['name', 'buy_price', 'sell_price', 'description', 'is_active'];
	public $appends = ['picture'];
	protected $casts = [
		'is_active' => 'boolean'
	];

	public function getPictureAttribute()
	{
		if (File::exists(public_path() . "/products/" . Auth::user()->agent_id . "/$this->id.jpg"))
			return url('/products/' . Auth::user()->agent_id . '/' . $this->id . '.jpg');
		else
			return url('/img/upload_icon.png');
	}
}
