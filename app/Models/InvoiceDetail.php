<?php

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    public $connection = 'tenant';
    public $fillable = ['product_id', 'company_id', 'supplier_id', 'description', 'qty', 'price', 'price_nett'];
    public static $rules = [];

    function invoice() {
        return $this->belongsTo('Invoice');
    }

    function company() {
        return $this->belongsTo('Company', 'company_id');
    }

    function supplier() {
        return $this->belongsTo('Company', 'supplier_id');
    }

    function product() {
        return $this->belongsTo('Product');
    }

    protected $appends = ['display'];

    function getDisplayAttribute()
    {
        switch ($this->type)
        {
            case 'Ticket':
                return 'Ticket ' . $this->company->name . "\n" .
                    $this->from_where . " to " . $this->to_where . "\n" .
                    date('d M Y', strtotime($this->from_date));
            case 'Service':
                return $this->description;
            case 'Hotel':
                return 'Checkin ' . $this->company->name . "\n" .
                    date('d M Y', strtotime($this->from_date)) . ' to ' . date('d M Y', strtotime($this->to_date));
        }
    }
}
