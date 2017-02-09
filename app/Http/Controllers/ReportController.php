<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Charts;
use Invoice, Product, Purchase, Expense;
use Report;

class ReportController extends Controller
{
    protected $startDate = null;
    protected $endDate = null;

    public function stock()
    {
		$products = Product::orderBy('name')->get();
		return view('reports.stock', compact('products'));
    }

    public function receivables()
    {
        $total = 0;
        $data = Invoice::with('customer', 'total')
            ->whereNotIn('status', ['Draft', 'Completed'])
            ->orderBy('customer_id')
            ->get();

        return view('reports.receivables', compact('data', 'total'));
    }

    public function payables()
    {
        $data = Purchase::with('supplier', 'total')
            ->whereNotIn('status', ['Draft', 'Completed'])
            ->orderBy('supplier_id')
            ->get();

        return view('reports.payables', compact('data'));
    }

    protected function getAccountBalance($account_group_id)
    {
        $items = "SELECT account_groups.id, accounts.name,
            IF (account_groups.position = 'Debit', SUM(debit) - SUM(credit), SUM(credit) - SUM(debit)) as amount
            FROM transaction_details
            JOIN accounts ON transaction_details.account_id = accounts.id
            JOIN account_groups ON accounts.account_group_id = account_groups.id
            JOIN transactions ON transaction_details.transaction_id = transactions.id
            WHERE transactions.created_at BETWEEN :startDate AND :endDate
            AND accounts.account_group_id = :group
            GROUP BY transaction_details.account_id
            ORDER BY accounts.id";

        return DB::connection('tenant')->select($items, [ 'startDate' => Report::startDate(), 'endDate' => Report::endDate(), 'group' => $account_group_id ]);
    }

    public function incomeStatement()
    {
        $data = (object)[
            'revenue' => $this->getAccountBalance(7),
            'cgs' => $this->getAccountBalance(8),
            'expenses' => $this->getAccountBalance(9),
        ];

        $totals = [
            'revenue' => 0,
            'cgs' => 0,
            'expenses' => 0,
        ];

        return view('reports.income_statement', [
            'data' => $data,
            'totals' => $totals,
            'startDate' => Report::startDate(),
            'endDate' => Report::endDate()
        ]);
    }

    public function trialBalance()
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

		$data = DB::connection('tenant')->select($query, [Report::startDate(), Report::endDate()]);

        $totals = (object)[
            'debit' => 0,
            'credit' => 0,
        ];

        return view('reports.trial_balance', compact('data', 'totals'));
    }
}
