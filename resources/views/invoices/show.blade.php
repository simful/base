@extends('layouts.app')

@section('title')
	Invoice #{{ $invoice->id }}
@endsection

@section('content')
	<div class="container">
		<a href="{{ url('/invoices') }}">
			{{ trans('invoice.back_to_invoices') }}
		</a>

		<h2>@yield('title')</h2>

		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<label>{{ trans('invoice.order_by') }}</label>
						<p>{{ $invoice->customer->name }}</p>
					</div>
					<div class="col-md-3">
						<label>{{ trans('invoice.order_date') }}</label>
						<p>{{ d($invoice->created_at) }}</p>
					</div>
					<div class="col-md-3">
						<label>{{ trans('invoice.invoice') }} #</label>
						<p>{{ $invoice->id }}</p>
					</div>

					<div class="col-md-3">
						<label>{{ trans('invoice.payment_method') }}</label>
						<p>{{ $invoice->payment_method }}</p>
					</div>
				</div>

				<hr>

				<div class="row">
					<div class="col-md-3">
						<label>{{ trans('invoice.payment_status') }}</label>
						<p>
							@if ($invoice->paid)
								<span class="label label-success">{{ trans('invoice.paid') }}</span>
							@else
								<span class="label label-default">{{ trans('invoice.unpaid') }}</span>
							@endif
							<span class="label label-default">{{ $invoice->status }}</span>
						</p>
					</div>

					<div class="col-md-3">
						<label>{{ trans('invoice.total') }}</label>
						<p class="text-right">{{ m(count($invoice->total) ? $invoice->total[0]->price : 0) }}</p>
					</div>

					<div class="col-md-6">
						<div class="pull-right">

							@if ($invoice->status == 'Draft')
								<a href="{{ url("invoices/$invoice->id/edit") }}" class="btn btn-default">
									<i class="fa fa-pencil"></i>
									Edit Invoice
								</a>

								<a href="{{ url("invoices/$invoice->id/edit") }}" class="btn btn-default">
									<i class="fa fa-trash"></i>
									Delete Invoice
								</a>

								<button class="btn btn-primary invoice-action" data-action="send" data-id="{{ $invoice->id }}">
									<i class="fa fa-arrow-right"></i>
									Send
								</button>
							@endif

							@if ($invoice->status == 'Sent')
								<button class="btn btn-primary invoice-action" data-action="confirm-payment" data-id="{{ $invoice->id }}">
									<i class="fa fa-arrow-right"></i>
									Receive Payment...
								</button>
								<button class="btn btn-default">Cancel &amp; Delete Invoice</button>
							@endif

							@if ($invoice->status == 'Shipping')
								<button class="btn btn-default">Cancel Shipping</button>
							@endif

							@if ($invoice->status == 'In Progress')
								<button class="btn btn-primary">{{ trans('invoice.print_receipt') }}...</button>
								<button class="btn btn-primary">{{ trans('invoice.request_refund') }}</button>
							@endif

							@if ($invoice->status == 'Completed')

							@endif
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="box">
			<div class="box-body">
				<h4>{{ trans('invoice.details') }}</h4>

				<div class="row">
					<div class="col-md-2">

					</div>
					<div class="col-md-2"></div>
				</div>

				<form action="{{ url("invoices/add-item/$invoice->id") }}" method="post">
					<table class="table">
						<thead>
							<tr>
								<th>{{ trans('cart.item') }}</th>
								<th>{{ trans('cart.qty') }}</th>
								<th class="text-right">Unit Price</th>
								<th class="text-right">Subtotal</th>
								@if ($invoice->status == 'Draft')
									<th class="actions"></th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach ($invoice->details as $item)
								<tr>
									<td>{{ $item->description }}</td>
									<td>{{ $item->qty }}</td>
									<td class="text-right">{{ m($item->price) }}</td>
									<td class="text-right">{{ m($item->price * $item->qty) }}</td>
									@if ($invoice->status == 'Draft')
										<td>
											<button class="btn btn-default delete-item" type="button" data-id="{{ $item->id }}">
												<i class="fa fa-times"></i>
											</button>
										</td>
									@endif
								</tr>
							@endforeach

							@if ($invoice->status == 'Draft')
								<tr>
									<td>
										<input type="text" placeholder="Description" name="description" class="form-control">
									</td>
									<td style="max-width: 100px">
										<input type="number" placeholder="Qty" name="qty" class="form-control">
									</td>
									<td>
										<input type="number" placeholder="Unit Price" name="price" class="form-control">
									</td>

									<td class="text-right">
										<button class="btn btn-primary" type="submit">
											<i class="fa fa-plus"></i>
											Add Item
										</button>
									</td>
									<td></td>
								</tr>
							@endif
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3">{{ trans('cart.total') }}</th>
								<th class="text-right">{{ m(count($invoice->total) ? $invoice->total[0]->price : 0) }}</th>
								@if ($invoice->status == 'Draft')
									<th></th>
								@endif
							</tr>
						</tfoot>
					</table>

					@if (count($errors) > 0)
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif

				</form>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(document).ready(function() {
			$('.delete-item').click(function() {
				var itemId = $(this).attr('data-id');
				if (confirm('Are you sure you want to delete ' + itemId + '?')) {
					$.ajax('/invoices/remove-item/' + itemId, {
						method: 'POST',
						complete: function() {
							location.reload();
						}
					});
				}
			});

			$('.invoice-action').click(function() {
				var itemId = $(this).attr('data-id');
				var action = $(this).attr('data-action');
				$.ajax('/invoices/' + itemId + '/process?action=' + action, {
					method: 'POST',
					complete: function() {
						location.reload();
					}
				});
			});
		});
	</script>
@stop
