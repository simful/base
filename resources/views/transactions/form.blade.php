@extends('layouts.app')

@section('title')
	{{ $isEdit ? 'Edit' : 'Add' }} Transaction
@stop

@section('content')
	<div class="container">
		<h2>@yield('title')</h2>
		<div class="box">
			<div class="box-body">
				<form action="/transactions" method="post">
					{{ csrf_field() }}

					<div class="form-group">
						<label for="description" class="control-label">Description</label>
						<input type="text" class="form-control" value="{{ $transaction->description }}">
					</div>

					<hr>

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
										<input type="text" class="form-control" value="{{ $detail->account->name }}">
									</td>
									<td>
										<input type="text" class="form-control text-right" value="{{ $detail->debit ?: '' }}">
									</td>
									<td>
										<input type="text" class="form-control text-right" value="{{ $detail->credit ?: '' }}">
									</td>
									<td class="actions">
										<a class="btn btn-default">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<button class="btn btn-primary" type="button">
						<i class="fa fa-plus"></i>
						Add New Row
					</button>

					<hr>

					<button class="btn btn-primary btn-lg" type="submit">
						<i class="fa fa-check"></i> Save
					</button>

					<button type="button" class="btn btn-default btn-lg" onclick="history.back()">
						<i class="fa fa-times"></i> Cancel
					</button>
				</form>
			</div>
		</div>
	</div>
@stop
