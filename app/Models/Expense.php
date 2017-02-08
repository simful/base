<?php

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
	public $connection = 'tenant';
	public $guarded = ['id', 'created_at', 'updated_at'];

	function source_account()
	{
		return $this->belongsTo(Account::class, 'source_account_id');
	}

	function expense_account()
	{
		return $this->belongsTo(Account::class, 'expense_account_id');
	}

	function postToJournal()
	{
		// post to journal
        if ($this->paid) return;

        $transaction = new Transaction;
        $transaction->user_id = Auth::id();
        $transaction->description = $this->description;
        $transaction->save();

        $details = [
            new TransactionDetail([
                'account_id' =>  $this->expense_account_id, // expense
                'debit' => $this->amount,
                'credit' => 0
            ]),
            new TransactionDetail([
                'account_id' => $this->source_account_id, // cash/bank accounts
                'debit' => 0,
                'credit' => $this->amount
            ])
        ];

        $transaction->details()->saveMany($details);

        $this->paid = true;
        $this->save();
	}
}
