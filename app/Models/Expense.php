<?php

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
	public $guarded = ['id', 'created_at', 'updated_at'];

	function source_account()
	{
		return $this->belongsTo(Account::class, 'source_account_id');
	}

	function expense_account()
	{
		return $this->belongsTo(Account::class, 'expense_account_id');
	}
}
