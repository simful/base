<?php

namespace App\Lib;

use DB;

class Balance {
	static function get()
	{
		$query = "SELECT
			accounts.id,
			accounts.name as account,
			IF(account_groups.position = 'Debit', SUM(debit) - SUM(credit), null) as debit,
			IF(account_groups.position = 'Credit', SUM(credit) - SUM(debit), null) as credit
			FROM accounts
			LEFT OUTER JOIN transaction_details ON accounts.id = transaction_details.account_id
			LEFT OUTER JOIN transactions ON transaction_details.transaction_id = transactions.id
			JOIN account_groups ON accounts.account_group_id = account_groups.id
			WHERE transactions.created_at BETWEEN ? AND ?
			OR transactions.created_at = NULL
			GROUP BY accounts.id";

		$balance = DB::connection('tenant')->select($query, [Report::startDate(), Report::endDate()]);

		$totals = ['debit' => 0, 'credit' => 0];

		foreach ($balance as $row)
		{
			$totals['debit'] += $row->debit;
			$totals['credit'] += $row->credit;
		}

		return compact('periods', 'balance', 'totals');
	}
}
