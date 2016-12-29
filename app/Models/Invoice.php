<?php

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
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
}
