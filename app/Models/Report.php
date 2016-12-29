<?php

class Report {
	static function getPeriod()
	{
		if ( ! Request::has('startDate')) {
			$startDate = new \Carbon\Carbon('first day of this month');
		}
		else {
			$startDate = new \Carbon\Carbon(Request::get('startDate'));
		}

		if ( ! Request::has('endDate')) {
			$endDate = new \Carbon\Carbon('last day of this month');
		}
		else {
			$endDate = new \Carbon\Carbon(Request::get('endDate'));
		}

		$period = new stdClass;

		$period->startDate = $startDate->toDateTimeString();
		$period->endDate = $endDate->toDateTimeString();

		return $period;
	}
}
