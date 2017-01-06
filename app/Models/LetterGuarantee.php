<?php

use Illuminate\Database\Eloquent\Model;

class LetterGuarantee extends Model
{
    public $connection = 'tenant';
    public $fillable = ['supplier_id', 'date', 'number', 'ref_number', 'remarks'];

    public static $rules = [];

    function details()
    {
        return $this->hasMany('LetterGuaranteeDetail', 'letter_id');
    }

    function supplier()
    {
        return $this->belongsTo('Company', 'supplier_id');
    }

    function total() {
        return $this->hasMany('LetterGuaranteeDetail', 'letter_id')
            ->selectRaw('sum(price) as amount, letter_id')
            ->groupBy('letter_id');
    }
}
