<?php

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $connection = 'tenant';
    public $fillable = ['description', 'date',];
    public static $rules = [];

    function account() {
        return $this->belongsTo('Account');
    }

    function details() {
        return $this->hasMany('TransactionDetail');
    }

    function total()
    {
        return $this->hasMany('TransactionDetail')
            ->selectRaw('sum(debit) as debit, sum(credit) as credit')
            ->groupBy('transaction_id');
    }

    function isBalanced()
    {
        if (count($this->total))
        {
            return $this->total[0]->debit == $this->total[0]->credit;
        }

        return false;
    }
}
