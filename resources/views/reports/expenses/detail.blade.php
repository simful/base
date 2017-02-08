@extends('layouts.app')

@section('title')
	Expense Report - Detailed
@stop

@section('content')
	<div class="container">
		<div class="box">
			<div class="box-body">
				<div>
					<span class="pull-right">
						@include('reports.range_picker')
					</span>
					<h2>@yield('title')</h2>
				</div>

				@include('reports.expenses.nav')

				<hr>

				<table class="table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Category</th>
							<th>Description</th>
							<th class="text-right">Amount</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($expenses as $expense)
							<tr>
								<td>{{ d($expense->created_at) }}</td>
								<td>{{ $expense->expense_account->name }}</td>
								<td>{{ $expense->description }}</td>
								<td class="text-right">{{ m($expense->amount) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>

				{{ $expenses->links() }}
			</div>
		</div>
	</div>
@stop
