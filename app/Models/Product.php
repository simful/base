<?php

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public $connection = 'tenant';
	public $guarded = ['created_at', 'updated_at'];
	public $appends = ['picture'];

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

	public function updateStock($amount, $reason)
	{
		if ($this->type == 'Service') return;

		$oldStock = $this->stock;
		$this->stock += $amount;
		$this->save();

		StockHistory::create([
			'in' => $this->stock > $oldStock ? $this->stock - $oldStock : 0,
			'out' => $this->stock < $oldStock ? $oldStock - $this->stock : 0,
			'product_id' => $this->id,
			'user_id' => Auth::id(),
			'description' => $reason
		]);
	}
}
