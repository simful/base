@extends('layouts.app')

@section('title')
	Expense Report - by Date
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
							<th class="text-right">Amount</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($expenses as $expense)
							<tr>
								<td>{{ d($expense->created_at) }}</td>
								<td class="text-right">{{ m($expense->aggregate) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop
