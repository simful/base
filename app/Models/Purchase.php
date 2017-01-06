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
}
