<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Invoice, Product, Purchase;

class ReportController extends Controller
{
    protected $startDate = null;
    protected $endDate = null;

    public function __construct(Request $request)
    {
        if (!$request->has('startDate')) {
            $startDate = new \Carbon\Carbon('first day of this month');
        } else {
            $startDate = new \Carbon\Carbon($request->get('startDate'));
        }

        if (!$request->has('endDate')) {
            $endDate = new \Carbon\Carbon('last day of this month');
        } else {
            $endDate = new \Carbon\Carbon($request->get('endDate'));
        }

        $this->startDate = $startDate->toDateTimeString();
        $this->endDate = $endDate->toDateTimeString();
    }

    public function sales(Request $request)
    {
        $group = $request->get('group');

        $query = DB::connection('tenant')->table('transaction_details')
            ->whereAccountId(7010)
            ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id');

        if ($group == 1) {
            $query = $query->select([DB::raw('DATE(created_at) as created_at'), DB::raw('sum(credit - debit) as amount')])
                ->groupBy(DB::raw('DATE(created_at)'));
        } else {
            $query = $query->select([DB::raw('DATE(created_at) as created_at'), DB::raw('sum(credit - debit) as amount'), 'transactions.description'])
                ->groupBy('transaction_id');
        }

        $data = $query->get();

        return view('reports.sales', [
			'data' => $data,
			'group' => $group,
			'startDate' => $this->startDate,
			'endDate' => $this->endDate,
		]);
    }

    public function purchase(Request $request)
    {
		$group = $request->get('group');

        $query = DB::connection('tenant')->table('transaction_details')
            ->whereAccountId(1030)
            ->where('debit', '>', 0)
            ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id');

        if ($group == 1) {
            $query = $query->select([DB::raw('DATE(created_at) as created_at'), DB::raw('sum(debit - credit) as amount')])
                ->groupBy(DB::raw('DATE(created_at)'));
        } else {
            $query = $query->select([DB::raw('DATE(created_at) as created_at'), DB::raw('sum(debit - credit) as amount'), 'transactions.description'])
                ->groupBy('transaction_id');
        }

        $data = $query->get();

        return view('reports.purchases', [
			'data' => $data,
			'group' => $group,
			'startDate' => $this->startDate,
			'endDate' => $this->endDate,
		]);
    }

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

        return DB::connection('tenant')->select($items, [ 'startDate' => $this->startDate, 'endDate' => $this->endDate, 'group' => $account_group_id ]);
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

        return view('reports.income_statement', compact('data', 'totals'));
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

		$data = DB::connection('tenant')->select($query, [$this->startDate, $this->endDate]);

        $totals = (object)[
            'debit' => 0,
            'credit' => 0,
        ];

        return view('reports.trial_balance', compact('data', 'totals'));
    }
}
