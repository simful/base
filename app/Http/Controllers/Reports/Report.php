<?php

namespace App\Http\Controllers\Reports;
use Request;

class Report
{
	static function startDate()
	{
		if (!Request::has('startDate')) {
			$startDate = new \Carbon\Carbon('first day of this month');
		} else {
			$startDate = new \Carbon\Carbon(Request::get('startDate'));
		}

		return $startDate->toDateTimeString();
	}

	static function endDate()
	{
		if (!Request::has('endDate')) {
			$endDate = new \Carbon\Carbon('last day of this month');
		} else {
			$endDate = new \Carbon\Carbon(Request::get('endDate'));
		}

		return $endDate->toDateTimeString();
	}

}
