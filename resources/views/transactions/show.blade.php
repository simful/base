@extends('layouts.app')

@section('title')
	Transaction #{{ $transaction->id }}
@stop

@section('content')
	<div class="container">
		<a href="{{ url('transactions') }}">
			<i class="fa fa-arrow-circle-left fa-icon"></i>
			Back to Transactions
		</a>
		<h2>@yield('title')</h2>
		<div class="box">
			<div class="box-body">
				<form action="{{ url("transactions/$transaction->id") }}" method="post">
					<input type="hidden" name="_method" value="PUT">
					<div class="form-group">
						<label for="description" class="control-label">Description</label>
						<input type="text" class="form-control" name="description" value="{{ $transaction->description }}">
					</div>

					<button class="btn btn-primary" type="submit">
						<i class="fa fa-check"></i>
						Save Changes
					</button>
				</form>

				<hr>

				<form action="{{ url("transactions/add-item/$transaction->id") }}" method="post">
					<table class="table">
						<thead>
							<tr>
								<th>Account</th>
								<th>Debit</th>
								<th>Credit</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($transaction->details as $detail)
								<tr>
									<td>
										{{ $detail->account->name }}
									</td>
									<td class="text-right">
										{{ $detail->debit ?: '' }}
									</td>
									<td class="text-right">
										{{ $detail->credit ?: '' }}
									</td>
									<td class="actions">
										<a class="btn btn-default delete-item" data-id="{{ $detail->id }}">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
							@endforeach
							<tr>
								<td style="min-width: 200px">
									<select name="account_id" id="account_id" class="form-control selectize-single">
										@foreach ($accounts as $account)
											<option {{ old('account_id') == $account->id ? 'selected' : '' }} value="{{ $account->id }}">{{ $account->name }}</option>
										@endforeach
									</select>
								</td>
								<td>
									<input type="text" class="form-control text-right" value="{{ $predictedDebit }}" name="debit">
								</td>
								<td>
									<input type="text" class="form-control text-right" value="{{ $predictedCredit }}" name="credit">
								</td>
								<td class="actions">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-plus"></i>
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</form>

				@if (count($errors) > 0)
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<div class="alert {{ $transaction->isBalanced() ? 'alert-success' : 'alert-warning' }}">
					 {{ $transaction->isBalanced() ? 'This transaction is balanced.' : 'This transaction is not balanced.' }}
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script>
		$(document).ready(function() {
			$('.delete-item').click(function() {
				if (confirm('Are you sure you want to delete?')) {
					$.ajax('/transactions/remove-item/' + $(this).attr('data-id'), {
						method: 'post',
						complete: function(data) {
							location.reload();
						}
					});
				}
			});
		});
	</script>
@stop
