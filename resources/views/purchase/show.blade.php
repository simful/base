@extends('layouts.app')

@section('title')
	Purchase Order #{{ $purchase->id }}
@endsection

@section('content')
	<div class="container">
		<a href="{{ url('/purchases') }}">
			Back to Purchases
		</a>

		<h2>@yield('title')</h2>

		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<label>Supplier</label>
						<p>{{ $purchase->supplier->name }}</p>
					</div>
					<div class="col-md-3">
						<label>{{ trans('invoice.order_date') }}</label>
						<p>{{ $purchase->created_at->toFormattedDateString() }}</p>
					</div>
					<div class="col-md-3">
						<label>{{ trans('invoice.invoice') }} #</label>
						<p>{{ $purchase->id }}</p>
					</div>

					<div class="col-md-3">
						<label>{{ trans('invoice.payment_method') }}</label>
						<p>{{ $purchase->payment_method }}</p>
					</div>
				</div>

				<hr>

				<div class="row">
					<div class="col-md-3">
						<label>{{ trans('invoice.payment_status') }}</label>
						<p>
							@if ($purchase->paid)
								<span class="label label-success">{{ trans('invoice.paid') }}</span>
							@else
								<span class="label label-default">{{ trans('invoice.unpaid') }}</span>
							@endif
							<span class="label label-default">{{ $purchase->status }}</span>
						</p>
					</div>

					<div class="col-md-3">
						<label>{{ trans('invoice.total') }}</label>
						<p class="text-right">{{ m(count($purchase->total) ? $purchase->total[0]->price : 0) }}</p>
					</div>

					<div class="col-md-6">
						<div class="pull-right">
							<a href="{{ url("purchases/$purchase->id/edit") }}" class="btn btn-default">
								<i class="fa fa-pencil"></i>
								Edit Invoice
							</a>
							@if ($purchase->paid)
								<button class="btn btn-primary">{{ trans('invoice.print_receipt') }}...</button>
								<button class="btn btn-primary">{{ trans('invoice.request_refund') }}</button>
							@else
								@if ( ! in_array($purchase->status, ['Payment Confirmation', 'Canceled']))
									<form method="post" style="display: inline" action="{{ url('invoices/confirm/' . $purchase->id) }}">
										{{ csrf_field() }}
										<button class="btn btn-primary">{{ trans('invoice.confirm_payment') }}...</button>
									</form>
								@endif

								@if ($purchase->status != 'Canceled')
									<form method="post" style="display: inline" action="{{ url('invoices/cancel/' . $purchase->id) }}">
										{{ csrf_field() }}
										<button class="btn btn-default">{{ trans('invoice.cancel_order') }}</button>
									</form>
								@endif
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

				<form action="{{ url("purchases/add-item/$purchase->id") }}" method="post">
					<table class="table">
						<thead>
							<tr>
								<th>{{ trans('cart.item') }}</th>
								<th>{{ trans('cart.qty') }}</th>
								<th class="text-right">Unit Price</th>
								<th class="text-right">Subtotal</th>
								<th class="actions"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($purchase->details as $item)
								<tr>
									<td>{{ $item->description }}</td>
									<td>{{ $item->qty }}</td>
									<td class="text-right">{{ m($item->price) }}</td>
									<td class="text-right">{{ m($item->price * $item->qty) }}</td>
									<td>
										<button class="btn btn-default delete-item" type="button" data-id="{{ $item->id }}">
											<i class="fa fa-times"></i>
										</button>
									</td>
								</tr>
							@endforeach

							<tr>
								<td>
									<select name="product_id" id="product_id" class="form-control selectize-single">
										@foreach ($products as $product)
											<option value="{{ $product->id }}">{{ $product->name }}</option>
										@endforeach
									</select>
									<input type="text" placeholder="Description" name="description" class="form-control hide">
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
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3">{{ trans('cart.total') }}</th>
								<th class="text-right">{{ m(count($purchase->total) ? $purchase->total[0]->price : 0) }}</th>
								<th></th>
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
					$.ajax('/purchases/remove-item/' + itemId, {
						method: 'POST',
						complete: function() {
							location.reload();
						}
					});
				}
			});
		});
	</script>
@stop
