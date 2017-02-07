<?php

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public $connection = 'tenant';
	public $fillable = ['name', 'buy_price', 'sell_price', 'description', 'is_active', 'type'];
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

	public static function updateStock($productId, $amount)
	{
		$product = Product::find($productId);

		//if ($product->type == 'Product') {
		$product->stock += $amount;
		$product->save();

		StockHistory::create([
			'in' => $product->stock > $oldStock ? $product->stock - $oldStock : 0,
			'out' => $product->stock < $oldStock ? $oldStock - $product->stock : 0,
			'product_id' => $product->id,
			'user_id' => Auth::id(),
			'description' => $request->reason
		]);
	}
}
