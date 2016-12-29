@extends('layouts.app')

@section('title')
	Expenses
@endsection

@section('content')
	<div class="container">
		<h2>@yield('title')</h2>

		<div class="mbot20">
			<a href="{{ url('expenses/create') }}" class="btn btn-primary">
				<i class="fa fa-plus"></i>
				Expense
			</a>
		</div>

		<div class="box">
			<div class="box-body">
				<table class="table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Category</th>
							<th>Description</th>
							<th class="text-right">Amount</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($expenses as $expense)
							<tr>
								<td>{{ d($expense->created_at) }}</td>
								<td>{{ $expense->expense_account->name }}</td>
								<td>{{ $expense->notes }}</td>
								<td class="text-right">{{ m($expense->amount) }}</td>
								<td class="actions">
									<a class="btn btn-default" href="/expenses/{{ $expense->id }}/edit">
										<i class="fa fa-pencil"></i>
									</a>&nbsp;
									<a class="btn btn-default">
										<i class="fa fa-trash"></i>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

				{{ $expenses->links() }}
			</div>
		</div>
	</div>
@endsection
