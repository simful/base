<?php

class Report
{
	static function getDate($param, $default)
	{
		$date = Request::has($param) ? new Carbon(Request::get($param)) : new Carbon($default);
		return $date->toDateTimeString();
	}

	static function startDate()
	{
		return static::getDate('start-date', 'first day of this month');
	}

	static function endDate()
	{
		return static::getDate('end-date', 'last day of this month');
	}
}
