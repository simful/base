@extends('layouts.app')

@section('title')
	Invoice #{{ $invoice->id }}
@endsection

@section('content')
	<div class="container">

		<a href="{{ url('/invoices') }}" class="hidden-print">
			{{ trans('invoice.back_to_invoices') }}
		</a>

		<h2>@yield('title')</h2>

		<div class="row">
			<div class="col-md-8 col-lg-9 col-xs-12">
				<div class="box">
					<div class="box-body">
						<div class="row">
							<div class="col-xs-6 col-md-3">
								<label>{{ trans('invoice.order_by') }}</label>
								<p>{{ $invoice->customer->name }}</p>
							</div>
							<div class="col-xs-6 col-md-3">
								<label>{{ trans('invoice.order_date') }}</label>
								<p>{{ d($invoice->created_at) }}</p>
							</div>
							<div class="col-xs-6 col-md-3">
								<label>{{ trans('invoice.invoice') }} #</label>
								<p>{{ $invoice->id }}</p>
							</div>

							<div class="col-xs-6 col-md-3">
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
									<span class="label invoice-status {{ str_slug(strtolower($invoice->status)) }}">{{ $invoice->status }}</span>
								</p>
							</div>

							<div class="col-md-3">
								<label>{{ trans('invoice.total') }}</label>
								<p class="text-right">{{ m(count($invoice->total) ? $invoice->total[0]->price : 0) }}</p>
							</div>

							<div class="col-md-6">

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
										<th style="min-width: 150px">{{ trans('cart.item') }}</th>
										<th class="text-right">{{ trans('cart.qty') }}</th>
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
											<td>
												<b>{{ $item->product_id ? $item->product->name : '' }}</b><br>
												{{ $item->description }}
											</td>
											<td class="text-right">{{ $item->qty }}</td>
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
												<select name="product_id" class="form-control selectize-single">
													@foreach ($products as $product)
														<option value="{{ $product->id }}">{{ $product->name }}</option>
													@endforeach
												</select>
												<input type="text" placeholder="Description" name="description" class="form-control hide">
											</td>
											<td style="max-width: 100px">
												<input type="number" placeholder="Qty" name="qty" class="form-control text-right" value="1">
											</td>
											<td>
												<input type="number" placeholder="Unit Price (optional)" name="price" class="form-control">
											</td>

											<td class="text-right">
												<button class="btn btn-primary" type="submit">
													<i class="fa fa-plus"></i>
													Add Item
												</button>
											</td>
											<td></td>
										</tr>
										<tr>
											<td colspan="3" style="border-top: none">
												<input type="text" placeholder="Description (optional)" name="description" class="form-control">
											</td>
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
			<div class="col-md-4 col-lg-3 hidden-print">
				@include('invoices.actions')
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

			$('.delete-invoice').click(function() {
				if (confirm('Are you sure you want to delete this invoice?')) {
					$.ajax('/invoices/' + $(this).attr('data-id'), {
						method: 'DELETE',
						complete: function() {
							window.location = '/invoices';
						}
					});
				}
			});
		});
	</script>
@stop
