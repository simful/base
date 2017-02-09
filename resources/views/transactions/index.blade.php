@extends('layouts.app')

@section('title')
	Transactions
@stop

@section('content')
	<div class="container">
		<h2>@yield('title')</h2>
		<a href="/transactions/create" class="btn btn-primary mbot20">
			<i class="fa fa-plus"></i> Transaction
		</a>
		<div class="box">
			<div class="box-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="width: 100px">Date</th>
							<th>Description/Account</th>
							<th>Debit</th>
							<th>Credit</th>
							<th style="width: 1%">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($transactions as $transaction)
						<tr>
							<td rowspan="{{ count($transaction->details) + 1 }}">{{ $transaction->created_at->toFormattedDateString() }}</td>
							<td colspan="3" class="text-bold">{{ $transaction->description }}</td>
							<td rowspan="{{ count($transaction->details) + 1 }}" style="white-space: nowrap">
								<a class="btn btn-default" href="/transactions/{{ $transaction->id }}">
									<i class="fa fa-pencil"></i>
								</a>&nbsp;
								<a class="btn btn-default delete-transaction" data-id="{{ $transaction->id }}">
									<i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
							@foreach ($transaction->details as $detail)
								<tr>
									<td class="{{ $detail->credit > 0 ? 'pad-left' : '' }}">{{ $detail->account->name }}</td>
									<td class="format-money">{!! mp($detail->debit) !!}</td>
									<td class="format-money">{!! mp($detail->credit) !!}</td>
								</tr>
							@endforeach
						@endforeach
					</tbody>
				</table>

				{{ $transactions->links() }}
			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script>
		$(document).ready(function() {
			$('.delete-transaction').click(function() {
				if (confirm('Are you sure you want to delete this transaction?')) {
					$.ajax('/transactions/' + $(this).attr('data-id'), {
						method: 'delete',
						complete: function(data) {
							//console.log(data);
							location.reload();
						}
					});
				}
			});
		});
	</script>
@stop
