<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Charts;
use Invoice, Product, Purchase, Expense;

class ExpensesReportController extends Controller
{
	function index($path = 'byCategory')
	{
		if ( ! method_exists($this, $path)) $path = 'byDate';
		return $this->$path();
	}

	function byCategory()
	{
		$labels = [];
        $values = [];

        $data['groups'] = DB::connection('tenant')->select(
            "SELECT accounts.name, SUM(amount) as aggregate FROM expenses JOIN accounts ON expenses.expense_account_id = accounts.id GROUP BY expense_account_id"
        );

        foreach ($data['groups'] as $group) {
            $labels[] = preg_replace(['/Biaya/', '/Beban/'], ['', ''], $group->name);
            $values[] = $group->aggregate;
        }

        $data['chart'] = Charts::create('pie', 'chartjs')
            ->title('Expenses by Category')
            ->labels($labels)
            ->values($values)
            ->height(400)
            ->width(0)
            ->responsive(false);

		return view('reports.expenses.byCategory', $data);
	}

	function byDate()
	{
		$data['expenses'] = Expense::with('expense_account')
			->orderBy('created_at')
			->whereBetween('created_at', [Report::startDate(), Report::endDate()])
			->select([DB::raw('DATE(created_at)'), DB::raw('sum(amount) as aggregate')])
			->groupBy(DB::raw('DATE(created_at)'))
			->get();
        return view('reports.expenses.byDate', $data);
	}

	function detail()
	{
		$data['expenses'] = Expense::with('expense_account')
            ->orderBy('created_at')
            ->whereBetween('created_at', [Report::startDate(), Report::endDate()])
            ->paginate();

		return view('reports.expenses.detail', $data);
	}

}
