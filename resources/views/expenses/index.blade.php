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
								<td>{{ $expense->description }}</td>
								<td class="text-right">{{ m($expense->amount) }}</td>
								<td class="actions">
									@unless ($expense->paid)
										<button class="btn btn-success process-expense" data-id="{{ $expense->id }}" title="Post to Journal">
											<i class="fa fa-arrow-right"></i>
										</button>
										<a class="btn btn-default" href="/expenses/{{ $expense->id }}/edit" title="Edit Expense">
											<i class="fa fa-pencil"></i>
										</a>&nbsp;
										<a class="btn btn-default delete-expense" data-id="{{ $expense->id }}" title="Delete Expense">
											<i class="fa fa-trash"></i>
										</a>
									@endunless
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

@section('scripts')
	<script>
		$(document).ready(function() {
			$('.process-expense').click(function() {
				var expenseId = $(this).attr('data-id');
				if (confirm('Process this expense?')) {
					$.ajax('/expenses/' + expenseId + '/process', {
						method: 'POST',
						complete: function() {
							location.reload();
						}
					});
				}
			});

			$('.delete-expense').click(function() {
				var expenseId = $(this).attr('data-id');
				if (confirm('Are you sure you want to delete ' + expenseId + '?')) {
					$.ajax('/expenses/' + expenseId, {
						method: 'DELETE',
						complete: function() {
							location.reload();
						}
					});
				}
			});
		});
	</script>
@endsection
