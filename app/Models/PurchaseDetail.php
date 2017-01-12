<?php

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    public $connection = 'tenant';
    public $fillable = ['company_id', 'supplier_id', 'product_id', 'description', 'qty', 'price', 'price_nett'];
    public static $rules = [];

    function purchase() {
        return $this->belongsTo('Purchase');
    }

    function company() {
        return $this->belongsTo('Company', 'company_id');
    }

    function supplier() {
        return $this->belongsTo('Company', 'supplier_id');
    }

    function product() {
        return $this->belongsTo('Product', 'product_id');
    }
}
