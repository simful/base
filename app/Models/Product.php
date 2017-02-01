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
		if (File::exists(public_path() . "/img/products/" . Auth::user()->agent_id . "/$this->id.jpg"))
			return url('/img/products/' . Auth::user()->agent_id . '/' . $this->id . '.jpg');
		else
			return url('/img/upload_icon.png');
	}

	public function stockHistory()
	{
		return $this->hasMany('StockHistory');
	}
}
