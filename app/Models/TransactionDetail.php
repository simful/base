<?php

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    public $connection = 'tenant';
    public $fillable = ['account_id', 'debit', 'credit'];
    public static $rules = [];
	public $timestamps = false;

	protected $casts = ['debit' => 'float', 'credit' => 'float'];

    function transaction() {
        return $this->belongsTo('Transaction');
    }

	function account() {
		return $this->belongsTo('Account');
	}
}
