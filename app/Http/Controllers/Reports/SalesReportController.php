<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Charts;
use Invoice, Product, Purchase, Expense;

class SalesReportController extends Controller
{
	function index($path = 'byDate')
	{
		if ( ! method_exists($this, $path)) $path = 'byDate';
		return $this->$path();
	}

	function byDate()
	{
		$data = DB::connection('tenant')->table('transaction_details')
            ->whereAccountId(7010)
            ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
			->select([DB::raw('DATE(created_at) as created_at'), DB::raw('sum(credit - debit) as aggregate')])
            ->groupBy(DB::raw('DATE(created_at)'))
			->whereBetween('created_at', [Report::startDate(), Report::endDate()])
			->get();

		$chart = Charts::database($data, 'bar', 'chartjs')
                ->height(400)
                ->preaggregated(true)
                ->labels(['Sales'])
                ->groupByDay();

        return view('reports.sales.byDate', [
			'data' => $data,
			'chart' => $chart,
		]);
	}

	function detail()
	{
		$query = DB::connection('tenant')->table('transaction_details')
            ->whereAccountId(7010)
            ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
			->select([DB::raw('DATE(created_at) as created_at'), DB::raw('sum(credit - debit) as aggregate'), 'transactions.description'])
            ->groupBy('transaction_id')
			->whereBetween('created_at', [Report::startDate(), Report::endDate()]);

        $data = $query->get();

        return view('reports.sales.detail', [
			'data' => $data
		]);
	}
}
