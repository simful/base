<?php

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
	public $connection = 'tenant';
	public $guarded = ['id', 'created_at', 'updated_at'];
	public $table = 'stock_history';

	public function product()
	{
		return $this->belongsTo('Product');
	}
}
