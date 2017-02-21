<?php

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public $connection = 'tenant';
    public $guarded = [
        'id',
		'created_at',
		'updated_at'
    ];

    public static $rules = [
        //'customer_id' => 'required',
    ];

    public $dates = [
        'created_at',
        'updated_at'
    ];

    public function supplier()
    {
        return $this->belongsTo(Contact::class, 'supplier_id');
    }

    function details()
    {
        return $this->hasMany('PurchaseDetail');
    }

    function total()
    {
        return $this->hasMany('PurchaseDetail')
            ->selectRaw('sum(price * qty) as price, sum(price_nett * qty) as net, purchase_id')
            ->groupBy('purchase_id');
    }

    function process()
    {
        // can only processed when still draft.
        if ($this->status != 'Draft')
            return;

        // add transaction journal
		$transaction = new Transaction;
		$transaction->description = "Purchase Order #$this->id";
		$transaction->user_id = Auth::id();
		$transaction->save();

		// we need 2 parameters:
		// source account (default: cash)
		// destination account (default: deposit)

		$details = [
            new TransactionDetail([
                'account_id' => 1030, // deposit
                'debit' => $this->total[0]->price,
                'credit' => 0
            ]),
            new TransactionDetail([
                'account_id' => 1010, // kas
                'debit' => 0,
                'credit' => $this->total[0]->price
            ])
        ];

        $transaction->details()->saveMany($details);

		// update stock now for items with product id

		foreach ($this->details as $item)
		{
			if ($item->product_id) {
				$product = Product::find($item->product_id);
				$product->updateStock($item->qty, 'Purchase Order #' . $this->id);

				$product->save();
			}
		}

        $this->status = 'Completed';
        $this->save();
    }
}
