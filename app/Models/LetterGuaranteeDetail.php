<?php

use Illuminate\Database\Eloquent\Model;

class LetterGuaranteeDetail extends Model
{
    public $connection = 'tenant';
    public $fillable = ['letter_id', 'description', 'price', 'currency'];

    public static $rules = [];
	public $timestamps = false;

	function letter()
	{
		return $this->belongsTo('LetterGuarantee', 'letter_id');
	}
}
