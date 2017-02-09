<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Charts;
use Invoice, Product, Purchase, Expense;

class PurchasesReportController extends Controller
{
	function index($path = 'byDate')
	{
		if ( ! method_exists($this, $path)) $path = 'byDate';
		return $this->$path();
	}

	function byDate()
	{
		$query = DB::connection('tenant')->table('transaction_details')
            ->whereAccountId(1030)
            ->where('debit', '>', 0)
            ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
			->select([DB::raw('DATE(created_at) as created_at'), DB::raw('sum(debit - credit) as amount')])
            ->groupBy(DB::raw('DATE(created_at)'))
			->whereBetween('created_at', [Report::startDate(), Report::endDate()]);

        $data = $query->get();

        return view('reports.purchases.byDate', compact('data'));
	}

	function detail()
	{
		$query = DB::connection('tenant')->table('transaction_details')
            ->whereAccountId(1030)
            ->where('debit', '>', 0)
            ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
			->select([DB::raw('DATE(created_at) as created_at'), DB::raw('sum(debit - credit) as amount'), 'transactions.description'])
            ->groupBy('transaction_id')
			->whereBetween('created_at', [Report::startDate(), Report::endDate()]);

        $data = $query->get();

        return view('reports.purchases.detail', compact('data'));
	}
}
