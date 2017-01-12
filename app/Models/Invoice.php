<?php

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $connection = 'tenant';
    public $fillable = [
        'customer_id',
        'user_id',
        'date',
        'due_date',
        'reference_number',
        'limit',
        'status',
        'notes'
    ];

    public static $rules = [
        //'customer_id' => 'required',
    ];

    public $dates = [
        'created_at',
        'updated_at',
        'due_date',
    ];

    function details()
    {
        return $this->hasMany('InvoiceDetail');
    }

    function total()
    {
        return $this->hasMany('InvoiceDetail')
            ->selectRaw('sum(price * qty) as price, sum(price_nett * qty) as net, invoice_id')
            ->groupBy('invoice_id');
    }

    function customer()
    {
        return $this->belongsTo('Contact');
    }

    function refunds()
    {
        return $this->hasMany('Refund');
    }

    function getAmountAttribute()
    {
        $relation = array_get($this->relations, 'amountSum');
        return $relation ? $relation->aggregate : null;
    }

    function post()
    {
        // add transaction journal.
        $transaction = new Transaction;
        $transaction->description = 'Invoice #' . $this->id;
        $transaction->user_id = Auth::id();
        $transaction->save();

        $details = [
            new TransactionDetail([
                'account_id' => 1010, // asset
                'debit' => $this->total[0]->price,
                'credit' => 0
            ]),
            new TransactionDetail([
                'account_id' => 7010, // penjualan
                'debit' => 0,
                'credit' => $this->total[0]->price
            ]),
            new TransactionDetail([
                'account_id' => 8010, // hpp
                'debit' => $this->total[0]->net ?: 0,
                'credit' => 0
            ]),
            new TransactionDetail([
                'account_id' => 1030,
                'debit' => 0,
                'credit' => $this->total[0]->net ?: 0
            ])
        ];

        $transaction->details()->saveMany($details);

        return $transaction;
    }

    public function updateStock()
    {
        foreach ($this->details as $detail) {
            $detail->product->stock -= $detail->qty;
            $detail->product->save();
        }
    }

    public function getActionMap()
    {
        $action_map = [
            'Draft' => ['send', 'delete'],
            'Sent' => ['confirm-payment', 'cancel'],
            'In Progress' => ['ship', 'complete', 'cancel'],
            'Shipping' => ['receive', 'complain'],
            'Completed' => ['refund']
        ];

        return $action_map[$this->status];
    }

    public function process($action)
    {
        switch ($action) {
            case 'delete':
                $this->destroy();
                return;
            case 'confirm-payment':
                // lock this invoice
                $this->post();
                $this->updateStock();
                $this->status = 'In Progress';
                break;
            case 'cancel':
                $this->status = 'Canceled';
                break;
            case 'send':
                // prevent empty invoice
                if ( ! count($this->total[0]) )
                    return;

                // print or email it or both
                $this->status = 'Sent';
                break;
            case 'complete':
                $this->status = 'Completed';
                break;
        }

        $this->save();
    }
}
